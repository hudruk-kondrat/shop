<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name Название
 * @property string|null $path Путь к картинке
 * @property float $price Цена
 * @property int|null $quantity Количество
 * @property string $description Описание
 * @property bool|null $active Активен
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'description'], 'required'],
            [['price'], 'number'],
            [['quantity'], 'default', 'value' => null],
            [['quantity'], 'integer'],
            [['active'], 'boolean'],
            [['name', 'path', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'path' => 'Путь к картинке',
            'price' => 'Цена',
            'quantity' => 'Количество',
            'description' => 'Описание',
            'active' => 'Активен',
        ];
    }
}
