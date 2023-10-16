<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase".
 *
 * @property int $id
 * @property int $user_id Покупатель
 * @property string|null $bank_response Ответ банка
 * @property string $customer_choice Выбранные товары
 *
 * @property User $user
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'customer_choice'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['bank_response', 'customer_choice'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Покупатель',
            'bank_response' => 'Ответ банка',
            'customer_choice' => 'Выбранные товары',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}