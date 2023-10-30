<?php

namespace app\models;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "basket".
 *
 * @property int $id
 * @property int $user_id Логин
 * @property int $product_id Пароль
 * @property int $count Имя
 * @property string|null $moment Время добавления
 *
 * @property Product $product
 * @property User $user
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'count'], 'required'],
            [['user_id', 'product_id', 'count'], 'default', 'value' => null],
            [['user_id', 'product_id', 'count'], 'integer'],
            [['moment'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
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
            'user_id' => 'Пользователь',
            'product_id' => 'Товар',
            'count' => 'Количество',
            'moment' => 'Время добавления',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
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


    public static function getSumm($array){
        $summ=0;
        $products = new ActiveDataProvider([
            'query' => Basket::find()->where(['id' => $array]),
        ]);
        foreach ($products->models as $product) {
            $summ+=$product->product->price*$product->count;
        }
        return $summ;
    }

    public static function getCustomerChoice($array){
        $result = array();
        $products = new ActiveDataProvider([
            'query' => Basket::find()->where(['id' => $array]),
        ]);
        foreach ($products->models as $product) {
            $result[]=['id'=> $product->product->id,
                        'name'=> $product->product->name,
                        'count'=> $product->count,
                        'price'=> $product->product->price,
                    ];
        }
        return $result;
    }



}
