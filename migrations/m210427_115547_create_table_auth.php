<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%auth}}`.
 */
class m210427_115547_create_table_auth extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%auth}}', [

            'id' => $this->primaryKey()->unsigned()->notNull(),
            'user_id' => $this->bigint()->unsigned()->notNull(),
            'source' => $this->string(255)->notNull(),
            'source_id' => $this->string(255)->notNull(),

        ]);
 
        // creates index for column ``
        $this->createIndex(
            '',
            '{{%auth}}',
            ''
        );

        // add foreign key for table ``
        $this->addForeignKey(
            '',
            '{{%auth}}',
            '',
            '{{%}}',
            '',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table ``
        $this->dropForeignKey(
            '',
            '{{%auth}}'
        );

        // drops index for column ``
        $this->dropIndex(
            '',
            '{{%auth}}'
        );

        $this->dropTable('{{%auth}}');
    }
}
