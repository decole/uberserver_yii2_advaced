<?php

namespace common\forms;

use yii\base\Model;

class BaseValidateForm extends Model
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
     * @var
     */
    public $processor;

    public function __construct(string $topic, string $payload, $processor, array $config = [])
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

    }

    public static function getTextNotify($string, $substring)
    {
        return str_replace('{value}', $substring, $string );
    }
}