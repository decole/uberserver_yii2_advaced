<?php

namespace common\modules\yandexSmartHome\controllers;

use yii\web\Controller;

/**
 * Default controller for the `yandex_smart_home` module
 */
class MainController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdmin()
    {
        return $this->render('index');
    }
}
