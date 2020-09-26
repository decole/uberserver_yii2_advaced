<?php

use yii\db\Migration;

/**
 * Class m200926_161420_history_fire_secure_table
 */
class m200926_161420_history_fire_secure_table extends Migration
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

        $this->createTable('history_fire_secure_data', [
            'id' => $this->primaryKey(),
            'topic' => $this->string()->notNull(),
            'payload' => $this->string(),
            'created_at' => $this->integer()->notNull(),

        ], $tableOptions);

        $this->createIndex(
            'idx-history_fire_secure_data-topic',
            'history_fire_secure_data',
            'topic'
        );

        $this->createIndex(
            'idx-history_fire_secure_data-created_at',
            'history_fire_secure_data',
            'created_at'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-history_fire_secure_data-topic',
            'history_fire_secure_data'
        );

        $this->dropIndex(
            'idx-history_fire_secure_data-created_at',
            'history_fire_secure_data'
        );

        $this->dropTable('history_fire_secure_data');
    }
}
