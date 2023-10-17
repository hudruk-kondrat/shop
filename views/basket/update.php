<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Basket $model */

$this->title = 'Изменение заказа: ' . $model->product->name;
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['index']];
?>
<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
<div class="basket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
