<?php

namespace common\modules\yandexSkill;

use Yii;
use yii\console\Application;

/**
 * telegram module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\yandexSkill\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (Yii::$app instanceof Application) {
            $this->controllerNamespace = 'common\modules\yandexSkill\commands';
        }
    }
}
