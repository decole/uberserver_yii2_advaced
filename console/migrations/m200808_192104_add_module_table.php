<?php

use yii\db\Migration;

/**
 * Class m200808_192104_add_sensors_type_table
 */
class m200808_192104_add_module_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('module', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'type' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-module-name',
            'module',
            'name'
        );
    }

    public function down()
    {
        $this->dropIndex(
            'idx-module-name',
            'module'
        );

        $this->dropTable('module');
    }
}
