<?php

namespace common\forms;

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

    public function __construct($topic, $payload, array $config = [])
    {
        parent::__construct($config);
        $this->topic = $topic;
        $this->payload = $payload;
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
        return;
    }
}