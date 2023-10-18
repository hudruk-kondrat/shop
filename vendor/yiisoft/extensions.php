<?php

$vendorDir = dirname(__DIR__);

return array (
  'yiisoft/yii2-bootstrap5' => 
  array (
    'name' => 'yiisoft/yii2-bootstrap5',
    'version' => '2.0.4.0',
    'alias' => 
    array (
      '@yii/bootstrap5' => $vendorDir . '/yiisoft/yii2-bootstrap5/src',
    ),
    'bootstrap' => 'yii\\bootstrap5\\i18n\\TranslationBootstrap',
  ),
  'yiisoft/yii2-debug' => 
  array (
    'name' => 'yiisoft/yii2-debug',
    'version' => '2.1.25.0',
    'alias' => 
    array (
      '@yii/debug' => $vendorDir . '/yiisoft/yii2-debug/src',
    ),
  ),
  'yiisoft/yii2-faker' => 
  array (
    'name' => 'yiisoft/yii2-faker',
    'version' => '2.0.5.0',
    'alias' => 
    array (
      '@yii/faker' => $vendorDir . '/yiisoft/yii2-faker/src',
    ),
  ),
  'yiisoft/yii2-gii' => 
  array (
    'name' => 'yiisoft/yii2-gii',
    'version' => '2.2.6.0',
    'alias' => 
    array (
      '@yii/gii' => $vendorDir . '/yiisoft/yii2-gii/src',
    ),
  ),
  'yiisoft/yii2-symfonymailer' => 
  array (
    'name' => 'yiisoft/yii2-symfonymailer',
    'version' => '2.0.4.0',
    'alias' => 
    array (
      '@yii/symfonymailer' => $vendorDir . '/yiisoft/yii2-symfonymailer/src',
    ),
  ),
  'kartik-v/yii2-krajee-base' => 
  array (
    'name' => 'kartik-v/yii2-krajee-base',
    'version' => '3.0.5.0',
    'alias' => 
    array (
      '@kartik/base' => $vendorDir . '/kartik-v/yii2-krajee-base/src',
    ),
  ),
  'kartik-v/yii2-dialog' => 
  array (
    'name' => 'kartik-v/yii2-dialog',
    'version' => '1.0.6.0',
    'alias' => 
    array (
      '@kartik/dialog' => $vendorDir . '/kartik-v/yii2-dialog/src',
    ),
  ),
  'kartik-v/yii2-grid' => 
  array (
    'name' => 'kartik-v/yii2-grid',
    'version' => 'dev-master',
    'alias' => 
    array (
      '@kartik/grid' => $vendorDir . '/kartik-v/yii2-grid/src',
    ),
  ),
  'unclead/yii2-multiple-input' => 
  array (
    'name' => 'unclead/yii2-multiple-input',
    'version' => '2.27.0.0',
    'alias' => 
    array (
      '@unclead/multipleinput' => $vendorDir . '/unclead/yii2-multiple-input/src',
      '@unclead/multipleinput/tests' => $vendorDir . '/unclead/yii2-multiple-input/tests',
      '@unclead/multipleinput/examples' => $vendorDir . '/unclead/yii2-multiple-input/examples',
    ),
  ),
);
