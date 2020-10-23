<?php

use yii\db\Migration;

/**
 * Class m200808_192137_add_module_type_table
 */
class m200808_192137_add_module_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('module_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-module-type',
            'module',
            'type',
            'module_type',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-module_type-name',
            'module_type',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropIndex(
            'idx-module-name',
            'module'
        );

        $this->dropForeignKey(
            'fk-module-type',
            'module_type'
        );

        $this->dropTable('module_type');
    }
}
