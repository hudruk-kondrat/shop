<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\User $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Для регистрации заполните форму ниже!</p>

    <div class="row">
        <div class="col-lg-5">
        <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

<?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>
<?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>


<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
