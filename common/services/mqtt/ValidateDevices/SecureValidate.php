<?php

namespace common\services\mqtt\ValidateDevices;

class SecureValidate implements DeviceInterface
{
    /**
     * @var string
     */
    public $topicList;
    /**
     * @var string
     */
    public $topicModel;

    public function __construct($topicList, $topicsModel)
    {
        $this->topicList = $topicList;
        $this->topicModel = $topicsModel;
        $this->createDataset();
    }

    /**
     * @inheritDoc
     *
     * secures_list - array current topics
     * secures      - models serialized in array
     */
    public function getTopics()
    {
        if (Cache::has($this->topicList)) {
            return $value = Cache::get($this->topicList);
        }
        $this->createDataset();
        return MqttSecure::all()->pluck('topic')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function createDataset()
    {
        $model = MqttSecure::all();
        $topics = $model->pluck('topic')->toArray();
        Cache::put($this->topicModel, $model);
        Cache::put($this->topicList, $topics);
    }

    /**
     * @inheritDoc
     */
    public function deviceValidate($message)
    {
        if (!Cache::has($this->topicModel) || is_null(Cache::get($this->topicModel))) {
            self::createDataset();
        }
        $model = Cache::get($this->topicModel);
        if (empty($model)) {
            self::createDataset();
            $model = MqttSecure::all();
            self::process($model, $message);
        } else {
            self::process($model, $message);
        }
    }

    private function process($model, $message)
    {
        foreach ($model as $value) {
            if ($value['topic'] == $message->topic) {
                if (
                    (integer)$value['alarm_condition'] == (integer)$message->payload &&
                    $value['trigger'] == true &&
                    DeviceService::is_notifying($value)
                ) {
                    MqttSecure::logAlarm($value['topic'], 'зафиксировано движение');
                    if ($value['notifying'] == true) {
                        $text = DataService::getTextNotify($value['message_warn'], (string)$message->payload);
                        DeviceService::SendNotify(new SecureNotify($text, $message));
                    }
                }
                break;
            }
        }
    }

}
