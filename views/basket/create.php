<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Basket $model */

$this->title = 'Добавление заказа: ' . $model->product->name;
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
