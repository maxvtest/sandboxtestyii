<?php

use yii\db\Migration;

/**
 * Handles the creation of table `api_attribute`.
 * Has foreign keys to the tables:
 *
 * - `api`
 * - `attribute`
 */
class m180327_200339_create_junction_table_for_api_and_attribute_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('api_attribute', [
            'api_id' => $this->integer(),
            'attribute_id' => $this->integer(),
            'value' => $this->string(32),
            'created_at' => $this->timestamp()->append('NOT NULL DEFAULT CURRENT_TIMESTAMP'),
            'PRIMARY KEY(api_id, attribute_id)',
        ]);

        // creates index for column `api_id`
        $this->createIndex(
            'idx-api_attribute-api_id',
            'api_attribute',
            'api_id'
        );

        // add foreign key for table `api`
        $this->addForeignKey(
            'fk-api_attribute-api_id',
            'api_attribute',
            'api_id',
            'api',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        // creates index for column `attribute_id`
        $this->createIndex(
            'idx-api_attribute-attribute_id',
            'api_attribute',
            'attribute_id'
        );

        // add foreign key for table `attribute`
        $this->addForeignKey(
            'fk-api_attribute-attribute_id',
            'api_attribute',
            'attribute_id',
            'attribute',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `api`
        $this->dropForeignKey(
            'fk-api_attribute-api_id',
            'api_attribute'
        );

        // drops index for column `api_id`
        $this->dropIndex(
            'idx-api_attribute-api_id',
            'api_attribute'
        );

        // drops foreign key for table `attribute`
        $this->dropForeignKey(
            'fk-api_attribute-attribute_id',
            'api_attribute'
        );

        // drops index for column `attribute_id`
        $this->dropIndex(
            'idx-api_attribute-attribute_id',
            'api_attribute'
        );

        $this->dropTable('api_attribute');
    }
}
