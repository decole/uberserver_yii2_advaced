<?php

use yii\db\Migration;

/**
 * Class m200813_191851_add_module_sensor_table
 */
class m200813_191851_add_module_sensor_table extends Migration
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

        $this->createTable('module_sensor', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'topic' => $this->string()->notNull()->unique(),
            'payload' => $this->string(32),
            'message_info' => $this->string(),
            'message_ok' => $this->string(),
            'message_warn' => $this->string(),
            'type' => $this->integer(),
            'location' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-module_sensor-type',
            'module_sensor',
            'type'
        );

        $this->createIndex(
            'idx-module_sensor-location',
            'module_sensor',
            'location'
        );

        $this->createIndex(
            'idx-module_sensor-topic',
            'module_sensor',
            'topic'
        );

        $this->createIndex(
            'idx-module_sensor-name',
            'module_sensor',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-module_sensor-type',
            'module_sensor'
        );

        $this->dropForeignKey(
            'fk-module_sensor-location',
            'module_sensor'
        );

        $this->dropIndex(
            'idx-module_sensor-topic',
            'module_sensor'
        );

        $this->dropIndex(
            'idx-module_sensor-name',
            'module_sensor'
        );

        $this->dropTable('module_sensor');
    }
}
