<?php

use yii\db\Migration;

/**
 * Handles the creation of table `api`.
 */
class m180327_194244_create_api_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('api', [
            'id' => $this->primaryKey(),
            'title' => $this->string(32)->notNull(),
            'required_attribute' => $this->string(32)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('api');
    }
}
