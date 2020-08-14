<?php

use yii\db\Migration;

/**
 * Class m200813_170715_add_location_table
 */
class m200813_170715_add_location_table extends Migration
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

        $this->createTable('location', [
            'id' => $this->primaryKey(),
            'location' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->createIndex(
            'idx-location',
            'location',
            'location'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-location',
            'location'
        );

        $this->dropTable('location');
    }
}
