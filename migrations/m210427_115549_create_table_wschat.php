<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%wschat}}`.
 */
class m210427_115549_create_table_wschat extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%wschat}}', [

            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(30)->notNull(),
            'text' => $this->string(1000)->notNull(),
            'ip' => $this->string(50),
            'created_at' => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'color' => $this->string(7),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%wschat}}');
    }
}
