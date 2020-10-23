<?php

use yii\db\Migration;

/**
 * Class m200901_193405_fire_system_table
 */
class m200901_193405_fire_system_table extends Migration
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

        $this->createTable('module_fire_system', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'topic' => $this->string()->notNull()->unique(),
            'normal_condition' => $this->string()->comment('значение нормы'),
            'alarm_condition' => $this->string()->comment('значение сработки'),
            'message_info' => $this->string(),
            'message_ok' => $this->string(),
            'message_warn' => $this->string(),
            'type' => $this->integer(),
            'location' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'notifying' => $this->boolean()->defaultValue(0),
            'active' => $this->boolean()->defaultValue(0),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-module_fire_system-type',
            'module_fire_system',
            'type',
            'module_type',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_fire_system-location',
            'module_fire_system',
            'location',
            'location',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-module_fire_system-topic',
            'module_fire_system',
            'topic'
        );

        $this->createIndex(
            'idx-module_fire_system-name',
            'module_fire_system',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-module_fire_system-type',
            'module_fire_system'
        );

        $this->dropForeignKey(
            'fk-module_fire_system-location',
            'module_fire_system'
        );

        $this->dropIndex(
            'idx-module_fire_system-topic',
            'module_fire_system'
        );

        $this->dropIndex(
            'idx-module_fire_system-name',
            'module_fire_system'
        );

        $this->dropTable('module_fire_system');
    }
}
