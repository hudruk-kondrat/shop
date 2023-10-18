<?php 
namespace app\components;

use yii\web\User;
use app\models\UserIdentification;
use app\models\Basket;
use PHPUnit\Framework\MockObject\Builder\Identity;

/**
 * @property UserIdentification $identity
 * @property-read int|null $id
 */
class WebUser extends User{

public function init(){
    parent::init();

    //\Yii::info('test');
    if ($this->isGuest) return; 

    $this->identity->updateAttributes([
        'lastvisit'=>new \yii\db\Expression('NOW()'),
    ]);
}

public function getFio()
{
    if ($this->isGuest) return null;

    return \Yii::$app->user->identity->lastname.' '. mb_substr(\Yii::$app->user->identity->firstname, 0, 1).'.'.' '.mb_substr(\Yii::$app->user->identity->patronymic, 0, 1).'.';
}


public function getId()
{
    if ($this->isGuest) return null;

    return $this->identity->id;
}

public function getCountproduct(){
    if ($this->isGuest) return null;

    return Basket::find()->where(['user_id' => $this->identity->id])->count();

}






}