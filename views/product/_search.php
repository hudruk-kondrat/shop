<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Modal;
/** @var yii\web\View $this */
/** @var app\models\ProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-search">

    <?php 
    Modal::begin([
        'title' => 'Поиск товара',
        'toggleButton' => [
            'label' => 'Поиск товара',
            'class' => 'btn btn-warning',
            'tag' => 'button',
        ],
    ]); $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'path') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); 
    Modal::end(); ?>
</div>
