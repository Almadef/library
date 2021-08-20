<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storage}}`.
 */
class m200104_122120_create_storage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%storage}}',
            [
                'id' => $this->primaryKey(),
                'model_id' => $this->integer()->notNull(),
                'model_name' => $this->string()->notNull(),
                'description' => $this->string()->notNull(),
                'file_name' => $this->string()->notNull(),
                'file_type' => $this->string()->notNull(),
                'file_size' => $this->integer()->notNull(),
                'file_path' => $this->string()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'is_deleted' => $this->boolean()->notNull()->defaultValue(false),
            ],
            $tableOptions
        );

        $this->createIndex(
            'idx-storage-model_id',
            '{{%storage}}',
            'model_id'
        );

        $this->createIndex(
            'idx-storage-model_name',
            '{{%storage}}',
            'model_name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-storage-model_id',
            '{{%storage}}'
        );

        $this->dropIndex(
            'idx-storage-model_name',
            '{{%storage}}'
        );

        $this->dropTable('{{%storage}}');
    }
}
