<?php

use yii\db\Migration;

/**
 * Class m231016_104108_product
 */
class m231016_104108_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('Название'),
            'path'=>$this->string()->null()->comment('Путь к картинке'),
            'price'=>$this->double()->notNull()->comment('Цена'),
            'quantity'=>$this->integer()->Null()->comment('Количество'),
            'description'=>$this->string()->notNull()->comment('Описание'),
            'active'=>$this->boolean()->comment('Активен'),
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231016_104108_product cannot be reverted.\n";
        $this->dropTable('{{%product}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231016_104108_product cannot be reverted.\n";

        return false;
    }
    */
}
