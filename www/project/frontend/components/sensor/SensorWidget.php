<?php

namespace frontend\components\sensor;

use yii\base\Widget;

class SensorWidget extends Widget
{
    public $sensor;

    public function run()
    {
        return $this->render('@frontend/components/sensor/render', [
            'sensor' => $this->sensor,
        ]);
    }
}
