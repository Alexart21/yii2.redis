<?php

use yii\db\Migration;

/**
 * Class m210121_111221_create_table_auth
 */
class m210121_111221_create_table_auth extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('auth', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->bigInteger()->notNull()->unsigned(),
            'source' => $this->string()->notNull(),
            'source_id' => $this->string()->notNull(),
        ]);
//        $this->addPrimaryKey('id');
        $this->addForeignKey('fk-auth-user_id-user-id', 'auth', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth');
    }

}
