<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var app\models\Purchase $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Оплата';
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="purchase-create">

    <h1><?= Html::encode($this->title) ?></h1>


<div class="purchase-form">

    <?php $form = ActiveForm::begin(['action' => ['purchase/finish'],'options' => ['method' => 'post']]); ?>
    <?= $form->field($model, 'amount')->hiddenInput(['value'=> $summ])->label(false) ?>
    <?= Html::hiddenInput('selection', json_encode($selection)); ?>
    <?= $form->field($model, 'customer_choice')->hiddenInput(['value'=> json_encode($customer_choice)])->label(false) ?>
    <b>Идентификатор заказа: </b><?='order_'.\Yii::$app->user->id.'_'.time();?></br>
    <?= $form->field($model, 'order_number')->hiddenInput(['value'=> 'order_'.\Yii::$app->user->id.'_'.time()])->label(false) ?>
    <b>Покупатель: </b><?=\Yii::$app->user->getFio();?></br>
    <b>Товар: </b>

    <?= GridView::widget([
        'dataProvider' => $product,
        'showPageSummary' => true,
        'summary'=>'', 
        'columns' => [
            [
                'attribute' => 'product.name',
                'format'    => 'text',
                'label'     => Yii::t('app', 'Название товара'),
            ],
            [

                'value' => function($data){
                    if(!empty($data->product->path)) return Html::img(Url::toRoute($data->product->path),[
                        'style' => 'width:50px;'
                    ]);
                },
                'format' => 'raw',
                'label'     => Yii::t('app', 'Вид'),
            ],
            [
                'attribute' => 'count',
                'format'    => 'text',
                'label'     => Yii::t('app', 'Количество товара'),
            ],
            [
                'label'     => Yii::t('app', 'Цена за ваш заказ'),
                'value' => function($model){
                    return $model->product->price * $model->count;
                },
                'pageSummary' => true
            ],
        
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=> \Yii::$app->user->id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Оплатить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>

