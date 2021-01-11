<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%post}}`.
 */
class m210111_082403_create_table_post extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [

            'id' => $this->primaryKey()->unsigned()->notNull(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(255)->notNull(),
            'tel' => $this->string(30)->notNull(),
            'body' => $this->text()->notNull(),
            'date' => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'is_read' => $this->tinyInteger(1),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
