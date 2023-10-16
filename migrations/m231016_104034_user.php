<?php

use yii\db\Migration;

/**
 * Class m231016_104034_user
 */
class m231016_104034_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'login'=>$this->string()->notNull()->comment('Логин'),
            'password'=>$this->string()->notNull()->comment('Пароль'),
            'firstname'=>$this->string()->notNull()->comment('Имя'),
            'patronymic'=>$this->string()->notNull()->comment('Отчество'),
            'lastname'=>$this->string()->notNull()->comment('Фамилия'),
            'role'=>$this->string()->notNull()->defaultValue('buyer')->comment('Роль'),
            'lastvisit' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()'))->comment('Последний вход'),
        ]);

        $this->insert('{{%user}}', [ //добавление первого пользователя системы
            'login'=>'admin',
            'password'=>md5('admin'),
            'firstname'=>'Иван',
            'patronymic'=>'Иванович',
            'lastname'=>'Иванов',
            'role'=>'admin',
        ]);
        
        $this->insert('{{%user}}', [ //добавление первого пользователя системы
            'login'=>'user',
            'password'=>md5('user'),
            'firstname'=>'Петр',
            'patronymic'=>'Петрович',
            'lastname'=>'Петров',
            'role'=>'buyer',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230908_064128_user cannot be reverted.\n";
        $this->dropTable('{{%user}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231016_104034_user cannot be reverted.\n";

        return false;
    }
    */
}
