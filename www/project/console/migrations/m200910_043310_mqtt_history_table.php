<?php

use yii\db\Migration;

/**
 * Class m200910_043310_mqtt_history_table
 */
class m200910_043310_mqtt_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('history_module_data', [
            'id' => $this->primaryKey(),
            'topic' => $this->string(),
            'payload' => $this->string(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-history_module_data-topic',
            'history_module_data',
            'topic'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-history_module_data-topic',
            'history_module_data'
        );

        $this->dropTable('history_module_data');
    }
}
