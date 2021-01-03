<?php

use yii\db\Migration;

/**
 * Class m210103_010456_warehouse_things
 */
class m210103_010456_warehouse_things extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%warehouse_thing}}', [
            'id' => $this->primaryKey(),
            'box_id' => $this->integer()->unsigned()->null(),
            'sum' => $this->integer()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->null(),
            'photo' => $this->string()->null(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'warehouse_thing-name',
            '{{%warehouse_thing}}',
            'name'
        );

        $this->createIndex(
            'warehouse_thing-box_id',
            '{{%warehouse_thing}}',
            'box_id'
        );

        $this->createTable('{{%warehouse_box}}', [
            'id' => $this->primaryKey(),
            'rack_id' => $this->integer()->unsigned()->null(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'warehouse_box-name',
            '{{%warehouse_box}}',
            'name'
        );

        $this->createIndex(
            'warehouse_box-rack_id',
            '{{%warehouse_box}}',
            'rack_id'
        );

        $this->createTable('{{%warehouse_rack}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'warehouse_rack-name',
            '{{%warehouse_rack}}',
            'name'
        );

        $this->createTable('{{%warehouse_log}}', [
            'id' => $this->primaryKey(),
            'thing_id' => $this->integer()->unsigned()->notNull(),
            'thing_name' => $this->string()->notNull(),
            'move_from_box' => $this->integer()->unsigned()->notNull(),
            'move_to_box' => $this->integer()->unsigned()->notNull(),
            'move_from_rack' => $this->integer()->unsigned()->notNull(),
            'move_to_rack' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'warehouse_log-thing_name',
            '{{%warehouse_log}}',
            'thing_name'
        );

        $this->createTable('{{%warehouse_trash}}', [
            'id' => $this->primaryKey(),
            'entity_type' => $this->string()->notNull(),
            'entity_name' => $this->string()->notNull(),
            'description' => $this->string()->null(),
            'sum' => $this->decimal(5, 2)->defaultValue(0),
            'photo' => $this->integer()->unsigned()->null(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'warehouse_trash-entity_name',
            '{{%warehouse_trash}}',
            'entity_name'
        );

        $this->createIndex(
            'warehouse_trash-created_at',
            '{{%warehouse_trash}}',
            'created_at'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'warehouse_thing-name',
            '{{%warehouse_thing}}'
        );

        $this->dropIndex(
            'warehouse_thing-box_id',
            '{{%warehouse_thing}}'
        );

        $this->dropTable('{{%warehouse_thing}}');

        $this->dropIndex(
            'warehouse_box-name',
            '{{%warehouse_box}}'
        );

        $this->dropIndex(
            'warehouse_box-rack_id',
            '{{%warehouse_box}}'
        );

        $this->dropTable('{{%warehouse_box}}');

        $this->dropIndex(
            'warehouse_rack-name',
            '{{%warehouse_rack}}'
        );

        $this->dropTable('{{%warehouse_rack}}');

        $this->dropIndex(
            'warehouse_log-thing_name',
            '{{%warehouse_log}}'
        );

        $this->dropTable('{{%warehouse_log}}');

        $this->dropIndex(
            'warehouse_trash-entity_name',
            '{{%warehouse_trash}}'
        );

        $this->dropIndex(
            'warehouse_trash-created_at',
            '{{%warehouse_trash}}'
        );

        $this->dropTable('{{%warehouse_trash}}');
    }
}
