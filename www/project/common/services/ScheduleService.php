<?php

namespace common\services;

use common\models\Schedule;
use common\traits\instance;
use DateTime;
use Yii;
use yii\base\ErrorException;
use yii\console\Request;

class ScheduleService
{
    use instance;

    public function run(): void
    {
        $schedule = Schedule::find()->all();

        foreach ($schedule as $single) {
            $this->runCommand($single);
        }
    }

    protected function runCommand(Schedule $single): bool
    {
        if (!$single->next_run || $single->next_run == null) {
            Yii::error('Next run date for command not found. Skipping', __METHOD__);

            return false;
        }

        $nextRunDate = new DateTime($single->next_run);
        $currentDate = new DateTime('NOW');

        if ($currentDate > $nextRunDate) {
            if (!$single->begin()) {
                Yii::error('Schedule begin method failed', __METHOD__);
            }

            try {
                $argvDefault = ['yii'];
                $argvCommand = explode(' ', $single->command);
                $_SERVER['argv'] = array_merge($argvDefault, $argvCommand); //phpcs:ignore
                $request = new Request();
                [$route, $params] = $request->resolve();
                Yii::$app->runAction($route, $params);
            } catch (ErrorException $e) {
                Yii::error("Running command encountered an error.\n".$e->getMessage(), __METHOD__);
            }

            if (!$single->end()) {
                Yii::error('Schedule end method failed', __METHOD__);
            }

            return true;
        } else {
            Yii::error('Next run date for command is after current date. Skipping', __METHOD__);

            return false;
        }
    }
}
