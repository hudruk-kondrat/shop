<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login Логин
 * @property string $password Пароль
 * @property string $firstname Имя
 * @property string $patronymic Отчество
 * @property string $lastname Фамилия
 * @property string $role Роль
 * @property string|null $lastvisit Последний вход
 *
 * @property Purchase[] $purchases
 */
class User extends \yii\db\ActiveRecord
{
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'firstname', 'patronymic', 'lastname'], 'required'],
            [['lastvisit'], 'safe'],
            [['login', 'password', 'firstname', 'patronymic', 'lastname', 'role'], 'string', 'max' => 255],
            [['password_repeat'], 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают!"],
            [['login'], 'checkUniqueLogin']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'password_repeat' => 'Пароль (повторно)',
            'firstname' => 'Имя',
            'patronymic' => 'Отчество',
            'lastname' => 'Фамилия',
            'role' => 'Роль',
            'lastvisit' => 'Последний вход',
        ];
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::class, ['user_id' => 'id']);
    }


    public function getRol()
    {
        return \app\components\RbacItems::getRoleName($this->role);
    }


    public function beforeDelete()
    {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($this->id);
        return parent::beforeDelete();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) {
            if(isset($changedAttributes['role']) AND $this->role!=$changedAttributes['role']) {
                $auth = Yii::$app->authManager;
                $auth->revokeAll($this->id);
                $authorRole = $auth->getRole($this->role);
                $auth->assign($authorRole, $this->id);
            }
        } else {
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole($this->role);
            $auth->assign($authorRole, $this->id); 
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {

        if ($insert) {
            $this->password = md5($this->password);
        } else {
            if ($this->password != $this->getOldAttribute('password')) {
                $this->password = md5($this->password);
            }
        }
        return parent::beforeSave($insert);
    }


    public function checkUniqueLogin($attribute, $params)
    {
            $login = User::find()->where(['login'=> $this->login])->one();
            if ($login)
             {
                $this->addError($attribute, 'Логин уже занят!');
                return false;
            }
        
    }



}
