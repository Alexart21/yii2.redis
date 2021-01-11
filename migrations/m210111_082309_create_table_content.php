<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%content}}`.
 */
class m210111_082309_create_table_content extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%content}}', [

            'id' => $this->primaryKey()->unsigned()->notNull(),
            'page' => $this->string(255)->notNull(),
            'page_text' => $this->text()->notNull(),
            'title' => $this->string(255)->notNull(),
            'title_seo' => $this->string(255),
            'description' => $this->string(255),
            'last_mod' => $this->integer()->unsigned()->notNull(),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%content}}');
    }
}
