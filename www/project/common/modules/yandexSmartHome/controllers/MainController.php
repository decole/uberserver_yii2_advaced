<?php

namespace common\modules\yandexSmartHome\controllers;

use common\modules\yandexSmartHome\actions\DeviceAction;
use common\modules\yandexSmartHome\actions\DeviceQueryAction;
use common\modules\yandexSmartHome\actions\DeviceQueryActorAction;
use common\modules\yandexSmartHome\actions\IndexAction;
use common\modules\yandexSmartHome\actions\UnlinkAction;
use yii\web\Controller;

class MainController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        $this->enableCsrfValidation = false;
        parent::__construct($id, $module, $config);
    }

    public function actions(): array
    {
        return [
            'index' => [
                'class' => IndexAction::class,
            ],
            'unlink' => [
                'class' => UnlinkAction::class,
            ],
            'devices' => [
                'class' => DeviceAction::class,
            ],
            'devices-query' => [
                'class' => DeviceQueryAction::class,
            ],
            'devices-action' => [
                'class' => DeviceQueryActorAction::class,
            ],
        ];
    }

    public function actionAdmin()
    {
        return $this->render('index');
    }
}
