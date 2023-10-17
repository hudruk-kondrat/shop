<?php

use yii\db\Migration;

/**
 * Class m231016_104140_purchase
 */
class m231016_104140_purchase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purchase}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull()->comment('Покупатель'),
            'order number'=>$this->string()->notNull()->comment('Идентификатор заказа'),
            'bank_response'=>$this->json()->comment('Ответ банка'),
            'customer_choice'=>$this->json()->notNull()->comment('Выбранные товары'),
        ]);

        $this->createIndex(
            'idx-user_id',
            'purchase',
            'user_id'
        );

        $this->addForeignKey(
            'userIdx',  
            '{{%purchase}}',
            'user_id', 
            'user', 
            'id', 
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231016_104140_purchase cannot be reverted.\n";
        $this->dropForeignKey(
            'userIdx',
            'purchase'
        );

        $this->dropIndex(
            'idx-user_id',
            'purchase'
        );

        $this->dropTable('{{%purchase}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231016_104140_purchase cannot be reverted.\n";

        return false;
    }
    */
}
