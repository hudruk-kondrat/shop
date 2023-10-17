<?php

use yii\db\Migration;

/**
 * Class m231017_055521_basket
 */
class m231017_055521_basket extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%basket}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull()->comment('Пользователь'),
            'product_id'=>$this->integer()->notNull()->comment('Товар'),
            'count'=>$this->integer()->notNull()->comment('Количество'),
            'moment' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()'))->comment('Время добавления'),
        ]);

        $this->createIndex(
            'idf-user_id',
            'basket',
            'user_id'
        );

        $this->addForeignKey(
            'userIdf',  
            '{{%basket}}',
            'user_id', 
            'user', 
            'id', 
            'CASCADE'
        );

        $this->createIndex(
            'idx-product_id',
            'basket',
            'product_id'
        );

        $this->addForeignKey(
            'productIdf',  
            '{{%basket}}',
            'product_id', 
            'product', 
            'id', 
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231017_055521_basket cannot be reverted.\n";

        $this->dropForeignKey(
            'userIdf',
            'basket'
        );

        $this->dropIndex(
            'idf-user_id',
            'basket'
        );

        $this->dropForeignKey(
            'productIdf',
            'basket'
        );

        $this->dropIndex(
            'idx-product_id',
            'basket'
        );

        $this->dropTable('{{%basket}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231017_055521_basket cannot be reverted.\n";

        return false;
    }
    */
}
