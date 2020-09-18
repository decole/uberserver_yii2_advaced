<?php

use yii\db\Migration;

/**
 * Class m200918_183135_sensor_leakage_table
 */
class m200918_183135_sensor_leakage_table extends Migration
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

        $this->createTable('module_leakage', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'topic' => $this->string()->notNull()->unique(),
            'check_up' => $this->string()->notNull(),
            'check_down' => $this->string()->notNull(),
            'message_info' => $this->string(),
            'message_ok' => $this->string(),
            'message_warn' => $this->string(),
            'type' => $this->integer(),
            'location' => $this->integer(),
            'notifying' => $this->boolean()->defaultValue(0),
            'active' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-module_leakage-topic',
            'module_leakage',
            'topic'
        );

        $this->createIndex(
            'idx-module_leakage-location',
            'module_leakage',
            'location'
        );

        $this->createIndex(
            'idx-module_leakage-type',
            'module_leakage',
            'type'
        );

        $this->addForeignKey(
            'fk-module_leakage-location',
            'module_leakage',
            'location',
            'location',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_leakage-type',
            'module_leakage',
            'type',
            'module_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-module_leakage-type',
            'module_leakage'
        );

        $this->dropForeignKey(
            'fk-module_leakage-location',
            'module_leakage'
        );

        $this->dropIndex(
            'idx-module_leakage-topic',
            'module_leakage'
        );

        $this->dropIndex(
            'idx-module_leakage-location',
            'module_leakage'
        );

        $this->dropIndex(
            'idx-module_leakage-type',
            'module_leakage'
        );

        $this->dropTable('module_leakage');
    }
}
