<?php

namespace common\services\mqtt\ValidateProcessor;

use common\forms\SensorValidateForm;
use common\models\ModuleSensor;

class SensorProcessor extends BaseProcessor
{
    public function __construct($topicList, $topicsModel)
    {
        parent::__construct($topicList, $topicsModel, ModuleSensor::class, SensorValidateForm::class);
    }
}
