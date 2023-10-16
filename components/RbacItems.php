<?php

namespace app\components;

/**
 * Class RbacItems
 * @package app\components
 */
class RbacItems
{
  // для администратор
  const TASK_MANAGEMENT_USER = 'managementUser'; //управление пользователями
  const TASK_MANAGEMENT_PRODUCT = 'managementProduct'; //Управление товарами
  const TASK_VIEW_LOG_ACTION = 'viewLogBuyerAction'; //Просмотр лога действий покупателей;

  //для покупателя
  const BUYER_PURCHASE = 'buyerPurchase'; //Покупка;


  // роли
  const ROLE_BUYER = 'buyer';        //покупатель
  const ROLE_ADMIN = 'admin';            //администратор


  public static function getRole()
  {
    return [self::ROLE_BUYER => 'Покупатель',
        self::ROLE_ADMIN => 'Администратор'];
  }

  public static function getRoleName($name)
  {
    $arrayRole = array(
        "buyer" => "Покупатель",
        "admin" => "Администратор");
    return $arrayRole[$name];
  }
}