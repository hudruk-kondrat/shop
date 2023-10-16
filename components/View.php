<?php


namespace app\components;

use app\models\UserIdentification;
use yii;

class View extends \yii\web\View
{
    public function render($view, $params = [], $context = null, $isAccess=false)
    {
        if(!$isAccess) {
            return parent::render($view, $params, $context);
        }
        return parent::render(UserIdentification::getRole()."/".$view, $params, $context);
    }
}