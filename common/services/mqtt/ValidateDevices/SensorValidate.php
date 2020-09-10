<?php

namespace common\services\mqtt\ValidateDevices;

class SensorValidate implements DeviceInterface
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
     * sensor_list - array current topics
     * sensors     - models serialized in array
     */
    public function getTopics()
    {
        if (Cache::has($this->topicList)) {
            return $value = Cache::get($this->topicList);
        }

        $this->createDataset();
        return MqttSensor::all()->pluck('topic')->toArray();
    }

    /**
     * @inheritDoc
     * @return void
     */
    public function createDataset()
    {
        $model = MqttSensor::all();
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
            $model = MqttSensor::all();
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
                    ($value['from_condition'] && (integer)$message->payload < (integer)$value['from_condition']) ||
                    ($value['to_condition'] && (integer)$message->payload > (integer)$value['to_condition']) ||
                    ($value['type'] == 3 && (integer)$value['to_condition'] !== (integer)$message->payload) // leakage
                ) {
                    $text = DataService::getTextNotify($value['message_warn'], (string)$message->payload);
                    DeviceService::SendNotify(new SensorNotify($text, $message));
                }
                break;
            }
        }
    }

}
