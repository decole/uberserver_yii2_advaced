<?php

namespace common\components\queue;

use backend\jobs\SchedulerJob;
use Yii;

class Queue extends \yii\queue\db\Queue
{
    /**
     * @var mixed[][]
     */
    private array $tasks = [
        SchedulerJob::class => [
            'delay' => 60,
        ],
    ];

    public function init(): void
    {
        parent::init();

        $this->checkTaskInQueue();
    }

    private function checkTaskInQueue(): void
    {
        $queue = Yii::$app->db->createCommand('SELECT * FROM queue')->queryAll();

        foreach ($this->tasks as $task => $config) {
            foreach ($queue as $job) {
                $job = json_decode($job['job']);

                if ($job->class !== $task) {
                    $this->delay(60)->push(new $task($config));
                }
            }
        }
    }
}
