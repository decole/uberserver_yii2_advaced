<?php

namespace console\controllers;

use backend\jobs\DiagnosticSystemJob;
use backend\jobs\TelegramNotifyJob;
use DateTime;
use DateTimeZone;
use Yii;
use yii\console\Controller;
use yii\db\Query;

class SystemController extends Controller
{
    public function actionIndex() {
        echo 'System Controller';
        exit();
    }

    public function actionDiagnostic()
    {
        Yii::$app->queue->push(new TelegramNotifyJob([
            'message' => 'Старт диагностики системы. По завершению диагностики - придет другое сообщение',
        ]));

        Yii::$app->queue->push(new DiagnosticSystemJob([
            'type' => 'full',
        ]));

        exit();
    }
/*
    public function actionMig()
    {
        $this->info('start process');

        $rows = (new Query())
            ->select(['temperature', 'spec', 'created_at'])
            ->from('weather_old')
            ->all();

        $chanks = array_chunk($rows, 20);
        $count = count($chanks);
        $this->info('count: ' . $count);
        $i = 1;

        foreach ($chanks as $items) {
            $this->info("$i / $count");

            foreach ($items as $item) {
                $date = $this->dateConvert($item['created_at']);
                $command = Yii::$app->db->createCommand();
                $command->insert('weather', [
                    'temperature'=> $item['temperature'],
                    'spec' => $item['spec'],
                    'created_at' => $date,
                    'updated_at' => $date,
                ])->execute();
            }

            $i++;
        }

        $this->info('Done !');
    }
*/
    public function actionMig1()
    {
        $limit = 1000;
        $offset = 0;

        $this->info('start process');

        $counter = $rows = (new Query())
            ->select(['id'])
            ->from('mqtt_histories')
            ->count();

        $bastion = ceil ($counter / $limit);

        
        for ($i = 0; $i <= $bastion; $i++) {
            $this->info("$i / $bastion");
            $offset = $i * $limit;
            $this->chankFacker($limit, $offset);
            $this->info('tik: ' . $i);
        }

        $this->info('end process');
    }

    private function chankFacker($limit, $offset)
    {
        $rows = (new Query())
            ->select(['topic', 'payload', 'created_at'])
            ->from('mqtt_histories')
            ->limit($limit)
            ->offset($offset)
            ->all();

        $chanks = array_chunk($rows, 20);
        $i = 1;

        foreach ($chanks as $items) {
            foreach ($items as $item) {
                $date = $this->dateConvert($item['created_at']);
                $command = Yii::$app->db->createCommand();
                $command->insert('history_module_data', [
                    'topic'=> $item['topic'],
                    'payload' => $item['payload'],
                    'created_at' => $date,
                ])->execute();
            }

            $i++;
        }

        $this->info('Done !');
    }

    private function info($message)
    {
        echo var_export($message, true) . PHP_EOL;
    }

    private function dateConvert($string)
    {
        $d = new DateTime($string, new DateTimeZone('Europe/Volgograd'));
        return $d->getTimestamp();
    }
}