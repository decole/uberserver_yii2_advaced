<?php

use yii\db\Migration;

/**
 * Class m200905_200636_foreign_key_adds
 */
class m200905_200636_foreign_key_adds extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-module_relay-type',
            'module_relay',
            'type',
            'module_type',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_relay-location',
            'module_relay',
            'location',
            'location',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_sensor-type',
            'module_sensor',
            'type',
            'module_type',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-module_sensor-location',
            'module_sensor',
            'location',
            'location',
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
            'fk-module_relay-type',
            'module_relay'
        );

        $this->dropForeignKey(
            'fk-module_relay-location',
            'module_relay'
        );

        $this->dropForeignKey(
            'fk-module_relay-type',
            'module_sensor'
        );

        $this->dropForeignKey(
            'fk-module_relay-location',
            'module_sensor'
        );
    }
}
