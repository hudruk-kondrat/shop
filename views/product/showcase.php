<?php
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title =Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Добро пожаловать!</h1>

        <p class="lead">Это сайт сделан как тестовое задание, так что... :)</p>

    </div>

    <div class="body-content">

        <div class="row">
            <?php $counter=0; 
            if(!empty($models)){
            foreach($models as $model): $counter++; ?>
            <div class="col-lg-4 card <?=($counter % 3)==0?' ':' mb-3'?>">
                <h2><?=$model['name'];?></h2>
                <img class="card-img-top rounded float-start" style=" object-fit: cover; height: 300px; display:block;" src="<?='/'.$model['path'];?>" alt="Product image"><div class="card-body">
                <p><?=$model['description'];?></p>
                <p><b>Цена:</b><?=$model['price'];?><b>Р</b></p>



                <p><?php if(Yii::$app->user->can(\app\components\RbacItems::BUYER_PURCHASE)) {
                    echo Html::a('Купить',  ['basket/create', 'product_id' => $model['id']],['class' => 'btn btn-success']);
                }?></p>
                
            
            </div>
            </div>
            <?php endforeach;} else {?>
                <p class="lead">Ой, товаров неть! :)</p>
                <?php } ?>
        </div>

    </div>
</div>
