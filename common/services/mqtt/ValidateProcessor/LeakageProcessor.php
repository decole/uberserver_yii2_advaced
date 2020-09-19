<?php

namespace common\services\mqtt\ValidateProcessor;

use common\forms\LeakageValidateForm;
use common\models\ModuleLeakage;

class LeakageProcessor extends BaseProcessor
{
    public function __construct($topicList, $topicsModel)
    {
        parent::__construct($topicList, $topicsModel, ModuleLeakage::class, LeakageValidateForm::class);
    }
}
