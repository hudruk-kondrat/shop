<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Basket $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="basket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=> $model->user_id])->label(false) ?>

    <?= $form->field($model, 'product_id')->hiddenInput(['value'=> $model->product_id])->label(false) ?>
    <p><b>Изображение:</b><?=Html::img(Url::toRoute($model->product->path),[
                        'style' => 'width:150px;'
                    ])?></p>
    <p><b>Описание:</b><?=$model->product->description;?></p>
    <p><b>Цена:</b><?=$model->product->price;?><b>Р</b></p>
    <?= $form->field($model, 'count')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
