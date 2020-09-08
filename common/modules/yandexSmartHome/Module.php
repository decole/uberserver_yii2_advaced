<?php

namespace common\modules\yandexSmartHome;

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
    public $controllerNamespace = 'common\modules\yandexSmartHome\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (Yii::$app instanceof Application) {
            $this->controllerNamespace = 'common\modules\yandexSmartHome\commands';
        }
    }
}
