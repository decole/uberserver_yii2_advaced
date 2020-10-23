<?php

namespace common\services\mqtt\ValidateProcessor;

use common\forms\SecureValidateForm;
use common\models\ModuleSecureSystem;

class SecureProcessor extends BaseProcessor
{
    public function __construct($topicList, $topicsModel)
    {
        parent::__construct($topicList, $topicsModel, ModuleSecureSystem::class, SecureValidateForm::class);
    }
}
