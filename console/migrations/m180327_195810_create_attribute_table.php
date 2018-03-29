<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attribute`.
 */
class m180327_195810_create_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attribute', [
            'id' => $this->primaryKey(),
            'title' => $this->string(32)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('attribute');
    }
}
