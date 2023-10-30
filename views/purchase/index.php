<?php

use app\components\SberEqaer;
use app\models\Purchase;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PurchaseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user.login',
                'format'    => 'text',
                'label'     => Yii::t('app', 'Покупатель'),
            ],
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
          /*  [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Purchase $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],*/
        ],
    ]); ?>


</div>
