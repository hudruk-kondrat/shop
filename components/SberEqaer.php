<?php

namespace app\components;

/**
 * Class SberEqaer
 * @package app\components
 */
class SberEqaer
{
  // для банка
  const NAME_USER = 'user'; //Логин служебной учётной записи продавца. 
  const PASS_USER = 'pass'; //Пароль служебной учётной записи продавца. 

  const RETURN_URL = 'managementUser'; //Адрес, на который требуется перенаправить пользователя в случае успешной оплаты, а также в случае неуспешной оплаты (при отсутствии переданного параметра failUrl).

  public $orderStatus = array(
	0 => 'Заказ зарегистрирован, но не оплачен',
	1 => 'Предавторизованная сумма захолдирована (для двухстадийных платежей)',
	2 => 'Проведена полная авторизация суммы заказа',
	3 => 'Авторизация отменена',
	4 => 'По транзакции была проведена операция возврата',
	5 => 'Инициирована авторизация через сервер контроля доступа банка-эмитента',
	6 => 'Авторизация отклонена',
);


//оплата
  public static function getPay($orderNumber,$amount)
  {
    $data_for_bank = array();
    $data_for_bank['userName'] = self::NAME_USER;
    $data_for_bank['password'] = self::PASS_USER;
    $data_for_bank['orderNumber'] = $orderNumber;
    $data_for_bank['amount'] = $amount * 100;
    $data_for_bank['returnUrl'] = self::RETURN_URL;
    $procces = curl_init('https://3dsec.sberbank.ru/payment/rest/register.do?' . http_build_query($data_for_bank));
    curl_setopt($procces, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($procces, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($procces, CURLOPT_HEADER, false);
    $result = curl_exec($procces);
    curl_close($procces);
    $result = json_decode($result, JSON_OBJECT_AS_ARRAY);
    return $result;						
  }

  //расшифровка статуса 
  public static function statusResult($code)
  {
    return self::$orderStatus[$code];
  }

//возврат
  public static function refund($orderId,$amount)
  {
    $data_for_bank = array();
    $data_for_bank['userName'] = self::NAME_USER;
    $data_for_bank['password'] = self::PASS_USER;
    $data_for_bank['orderId'] = $orderId;
    $data_for_bank['amount'] = $amount * 100; 
    $procces = curl_init('https://3dsec.sberbank.ru/payment/rest/refund.do?' . http_build_query($data_for_bank));
    curl_setopt($procces, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($procces, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($procces, CURLOPT_HEADER, false);
    $result = curl_exec($procces);
    curl_close($procces);
    $result = json_decode($result, JSON_OBJECT_AS_ARRAY);
    return $result;		
  }

//отмена оплаты
  public static function cancellation($orderId)
  {
    $data_for_bank = array();
    $data_for_bank['userName'] = self::NAME_USER;
    $data_for_bank['password'] = self::PASS_USER;
    $data_for_bank['orderId'] = $orderId;
    $procces = curl_init('https://3dsec.sberbank.ru/payment/rest/reverse.do?' . http_build_query($data_for_bank));
    curl_setopt($procces, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($procces, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($procces, CURLOPT_HEADER, false);
    $result = curl_exec($procces);
    curl_close($procces);
    $result = json_decode($result, JSON_OBJECT_AS_ARRAY);
    return $result;		
  }

//данные платежа
public static function statusExtended($orderId)
{
  $data_for_bank = array();
  $data_for_bank['userName'] = self::NAME_USER;
  $data_for_bank['password'] = self::PASS_USER;
  $data_for_bank['orderId'] = $orderId;
  $procces = curl_init('https://3dsec.sberbank.ru/payment/rest/getOrderStatusExtended.do?' . http_build_query($data_for_bank));
  curl_setopt($procces, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($procces, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($procces, CURLOPT_HEADER, false);
  $result = curl_exec($procces);
  curl_close($procces);
  $result = json_decode($result, JSON_OBJECT_AS_ARRAY);
  return $result;		
}


}