<?php

use yii\db\Migration;

/**
 * Class m200820_190839_create_table_module_relay
 */
class m200820_190839_create_table_module_relay extends Migration
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

        $this->createTable('module_relay', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'topic' => $this->string()->notNull()->unique(),
            'check_topic' => $this->string(),
            'command_on' => $this->string()->notNull(),
            'command_off' => $this->string()->notNull(),
            'check_command_on' => $this->string(),
            'check_command_off' => $this->string(),
            'last_command' => $this->string(),
            'message_info' => $this->string(),
            'message_ok' => $this->string(),
            'message_warn' => $this->string(),
            'type' => $this->integer(),
            'location' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-module_relay-topic',
            'module_relay',
            'topic'
        );

        $this->createIndex(
            'idx-module_relay-location',
            'module_relay',
            'location'
        );

        $this->createIndex(
            'idx-module_relay-type',
            'module_relay',
            'type'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-module_sensor-type',
            'module_sensor'
        );

        $this->dropTable('module_relay');
    }
}
