<?php

use yii\db\Migration;

/**
 * Class m200904_235905_shedule
 */
class m200904_235905_shedule extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('shedule', [
            'id'       => $this->primaryKey()->unique()->unsigned(),
            'command'  => $this->string(255)->notNull(),
            'interval' => $this->string(255),
            'last_run' => $this->dateTime(),
            'next_run' => $this->dateTime(),
            'created'  => $this->dateTime(),
            'updated'  => $this->dateTime(),
        ], $tableOptions);
    }

    public function down()
    {
        echo "m190318_095405_shedule cannot be reverted.\n";
        $this->dropTable('shedule');
        return true;
    }
}
