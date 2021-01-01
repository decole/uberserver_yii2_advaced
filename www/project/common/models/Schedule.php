<?php

namespace common\models;

use DateInterval;
use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "shedule".
 *
 * @property int $id
 * @property string $command
 * @property string $interval
 * @property string $last_run
 * @property string $next_run
 * @property string $created
 * @property string $updated
 */
class Schedule extends ActiveRecord
{
    public static function tableName()
    {
        return 'shedule';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    public function rules()
    {
        return [

            ['command', 'required'],
            [['created', 'updated', 'last_run', 'next_run'], 'safe'],
            [['command', 'interval'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'command' => 'Command',
            'interval' => 'Interval',
            'last_run' => 'Last Run',
            'next_run' => 'Next Run',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    public function begin(): bool
    {
        $this->next_run = null;

        return $this->save();
    }

    public function end() {
        $lastRunDate = new DateTime('NOW');
        $this->last_run = $lastRunDate->format('Y-m-d H:i:s');

        if($this->interval !== null && $this->interval !== '') {
            $interval = DateInterval::createFromDateString( $this->interval );
            $nextRunDate = $lastRunDate->add( $interval );
            $this->next_run = $nextRunDate->format('Y-m-d H:i:00');
        }

        return $this->save();
    }

    public static function add($command, $interval = null, $nextRun = null) {
        $model = new self;
        $model->command = $command;
        $model->interval = $interval;
        $model->last_run = null;
        $nextRunDate = new DateTime('NOW');
        $model->next_run = $nextRunDate->format('Y-m-d H:i:s');
        return $model->save();
    }

    /**
     * @param $task
     * @param $date
     */
    private function changeTimer($task, $date): void
    {
        $taskModel = self::find()->where(['command' => $task])->limit(1)->one();
        $taskModel->next_run = $date;
        $taskModel->save();
    }

    /**
     * changing time of this period time
     */
    private function setTimer(int $minutes): string
    {
        $dateTime = new DateTime();
        $now = $dateTime->getTimestamp();
        $dateTime->setTimestamp($now + $minutes * 60);

        return $dateTime->format('Y-m-d H:i:s');
    }
}
