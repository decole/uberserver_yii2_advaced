<?php

use yii\db\Migration;

/**
 * Class m200901_193418_secure_system_table
 */
class m200901_193418_secure_system_table extends Migration
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

        $this->createTable('module_secure_system', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'topic' => $this->string()->notNull()->unique(),
            'normal_condition' => $this->string()->comment('значение нормы'),
            'alarm_condition' => $this->string()->comment('значение сработки'),
            'trigger' => $this->boolean()->defaultValue(0),
            'current_command' => $this->string()->notNull(),
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
            'fk-module_secure_system-type',
            'module_secure_system',
            'type',
            'module_type',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_secure_system-location',
            'module_secure_system',
            'location',
            'location',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-module_secure_system-topic',
            'module_secure_system',
            'topic'
        );

        $this->createIndex(
            'idx-module_secure_system-name',
            'module_secure_system',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-module_secure_system-type',
            'module_secure_system'
        );

        $this->dropForeignKey(
            'fk-module_secure_system-location',
            'module_secure_system'
        );

        $this->dropIndex(
            'idx-module_secure_system-topic',
            'module_secure_system'
        );

        $this->dropIndex(
            'idx-module_secure_system-name',
            'module_secure_system'
        );

        $this->dropTable('module_secure_system');
    }
}
