<?php 
namespace app\components;

use yii\web\User;
use app\models\UserIdentification;
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

public function getId()
{
    if ($this->isGuest) return null;

    return $this->identity->id;
}





}