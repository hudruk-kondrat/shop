<?php

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


</div>
