<?php

use yii\db\Migration;

/**
 * Class m201109_185330_table_notification
 */
class m201109_185330_table_notification extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(100),
            'data' => $this->string(1000),
            'read_at' => $this->integer()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-notification-read_at',
            '{{%notification}}',
            'read_at'
        );

        $this->createIndex(
            'idx-notification-type',
            '{{%notification}}',
            'type'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'idx-notification-read_at',
            '{{%notification}}'
        );

        $this->dropIndex(
            'idx-notification-type',
            '{{%notification}}'
        );

        $this->dropTable('{{%notification}}');
    }
}
