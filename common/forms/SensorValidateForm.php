<?php

namespace common\forms;

use common\models\ModuleSensor;
use common\services\mqtt\ValidateProcessor\SensorProcessor;
use yii\base\Model;

class SensorValidateForm extends Model
{
    /**
     * @var
     */
    public $topic;

    /**
     * @var
     */
    public $payload;

    /**
     * @var SensorProcessor
     */
    public $processor;

    public function __construct($topic, $payload, $processor, array $config = [])
    {
        parent::__construct($config);
        $this->topic = $topic;
        $this->payload = $payload;
        $this->processor = $processor;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic' =>'Topic',
            'payload' => 'Payload',
        ];
    }
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['topic', 'payload'], 'trim'],
            [['topic', 'payload'], 'required'],
            ['payload', 'payloadValidator'],
        ];
    }

    public function payloadValidator(): void
    {
        /** @var ModuleSensor $model */
        $model = $this->processor->getSensorModel($this->topic);
        // TODO add notify param and active
        if ($model === null) {
            $this->addError('topic', 'не найден topic в сенсорах');
        }

        if ($model->from_condition && (integer)$this->payload > (integer)$model->from_condition) {
            $this->addError('payload', $model->name . ' показатели превышены, payload ' . $this->payload
            . ' | from_condition ' . $model->from_condition);
        }

        if ($model->to_condition && (integer)$this->payload < (integer)$model->to_condition) {
            $this->addError('payload', $model->name . ' показатели ниже нормы, payload ' . $this->payload
            . ' | from_condition ' . $model->to_condition);
        }
    }
}