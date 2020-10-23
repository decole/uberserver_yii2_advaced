<?php

namespace common\services\mqtt\ValidateProcessor;

use common\forms\FireSecureValidateForm;
use common\models\ModuleFireSystem;

class FireSecureProcessor extends BaseProcessor
{
    public function __construct($topicList, $topicsModel)
    {
        parent::__construct($topicList, $topicsModel, ModuleFireSystem::class, FireSecureValidateForm::class);
    }
}
