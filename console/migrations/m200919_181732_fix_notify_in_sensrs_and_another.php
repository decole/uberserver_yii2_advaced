<?php

use yii\db\Migration;

/**
 * Class m200919_181732_fix_notify_in_sensrs_and_another
 */
class m200919_181732_fix_notify_in_sensrs_and_another extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('module_sensor', 'notifying', $this->boolean()->defaultValue(1));
        $this->addColumn('module_sensor', 'active', $this->boolean()->defaultValue(1));

        $this->addColumn('module_relay', 'notifying', $this->boolean()->defaultValue(1));
        $this->addColumn('module_relay', 'active', $this->boolean()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('module_sensor', 'notifying');
        $this->dropColumn('module_sensor', 'active');

        $this->dropColumn('module_relay', 'notifying');
        $this->dropColumn('module_relay', 'active');
    }
}
