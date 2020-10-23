<?php

use yii\db\Migration;

/**
 * Class m200820_195827_module_sensor_modify
 */
class m200820_195827_module_sensor_modify extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('module_sensor', 'payload');
        $this->addColumn('module_sensor', 'to_condition', $this->integer());
        $this->addColumn('module_sensor', 'from_condition', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('module_sensor', 'payload', $this->string(32));
        $this->dropColumn('module_sensor', 'to_condition');
        $this->dropColumn('module_sensor', 'from_condition');
    }
}
