<?php
namespace common\modules\yandexSmartHome\commands;

use yii\console\Controller;

class AliceSkillController extends Controller
{
    public function actionIndex($message = 'hello world from module')
    {
        echo $message . "\n";
    }
}