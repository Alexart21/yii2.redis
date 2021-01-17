<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%chat}}`.
 */
class m210117_101412_create_table_chat extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [

            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(40)->notNull(),
            'text' => $this->string(1024)->notNull(),
            'ip' => $this->string(20),
            'created_at' => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'color' => $this->string(7),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat}}');
    }
}
