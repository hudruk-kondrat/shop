<?php

use app\components\SberEqaer;
use app\models\Purchase;
use app\models\Basket;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BasketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=Html::beginForm(['purchase/pay'],'post');?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
        'columns' => [
            [
                'header' => 'Выбрать',
                'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($model) {
                      return ['value' => $model->id];
                  },
            ],
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
                'attribute' => 'product.description',
                'format'    => 'text',
                'label'     => Yii::t('app', 'Описание товара'),
            ],
            [
                'attribute' => 'count',
                'format'    => 'text',
                'label'     => Yii::t('app', 'Количество товара'),
            ],
            [
                'attribute' => 'product.price',
                'format'    => 'text',
                'label'     => Yii::t('app', 'Цена за шт.'),
            ],
            'moment',
            [
                'label'     => Yii::t('app', 'Цена за ваш заказ'),
                'value' => function($model){
                    return $model->product->price * $model->count;
                },
                'pageSummary' => true
            ],
            [
                'class' => ActionColumn::className(),
                'header' => 'Действия',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, Basket $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
<?=Html::submitButton('Оплатить', ['class' => 'btn btn-primary']);?>
<?= Html::endForm();?> 

<h1>Покупки</h1>


<?= GridView::widget([
        'dataProvider' => $dataProviderPurchase,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'bank_response',
                'label'=>'Ответ банка',
                'content'=>function($data){
                    return SberEqaer::statusResult(json_decode($data->bank_response, true)['errorCode']);
                }
            ],
            [
                'attribute'=>'customer_choice',
                'label'=>'Выбранные товары',
                'content'=>function($data){
                        return Html::ul(json_decode($data->customer_choice, true), ['item' => function ($item) {
                            return Html::tag('li', '<b>Название:</b> '.$item['name'].';<br /> <b>Цена:</b> '.$item['count'].'<b>Р</b>;<br />  <b>Количество:</b> '.$item['count']);
                    }]);
                }
            ],
           
        ],
    ]); ?>
</div>
