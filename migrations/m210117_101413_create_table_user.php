<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%user}}`.
 */
class m210117_101413_create_table_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [

            'id' => $this->primaryKey()->unsigned()->notNull(),
            'username' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'role' => $this->tinyInteger()->defaultValue(10),
            'password_hash' => $this->string(255),
            'auth_key' => $this->string(255),
            'register_token' => $this->string(255),
            'password_reset_token' => $this->string(255),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
