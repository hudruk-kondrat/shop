<?php
namespace app\commands;

use app\components\RbacItems;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        //удалить все
        $auth->removeAll();
        
        //Добавляем роли
        $buyer = $auth->createRole(RbacItems::ROLE_BUYER); //покупатель
        $admin = $auth->createRole(RbacItems::ROLE_ADMIN); //админ
        
        // для администратор
        $managementUser = $auth->createPermission(RbacItems::TASK_MANAGEMENT_USER);
        $managementUser->description = 'Управление пользователями';
        $auth->add($managementUser);

        $managementProduct = $auth->createPermission(RbacItems::TASK_MANAGEMENT_PRODUCT);
        $managementProduct->description = 'Управление товарами';
        $auth->add($managementProduct);

        $viewLogBuyerAction = $auth->createPermission(RbacItems::TASK_VIEW_LOG_ACTION);
        $viewLogBuyerAction->description = 'Просмотр лога действий покупателей';
        $auth->add($viewLogBuyerAction);

        //для покупателя
        $buyerPurchase = $auth->createPermission(RbacItems::BUYER_PURCHASE);
        $buyerPurchase->description = 'Покупка';
        $auth->add($buyerPurchase);

        $auth->add($buyer);
        $auth->add($admin);

        //Добавляем права
        // для администратор
        $auth->addChild($admin,$managementUser);         //'Управление пользователями'
        $auth->addChild($admin,$managementProduct);         //'Управление товарами'
        $auth->addChild($admin,$viewLogBuyerAction);         //'Просмотр лога действий покупателей'
       
        //для покупателя
        $auth->addChild($buyer, $buyerPurchase);       //'Покупка'

        // Назначение ролей пользователям.
        $auth->assign($buyer, 2);
        $auth->assign($admin, 1);
    }
}

