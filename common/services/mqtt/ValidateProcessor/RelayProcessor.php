<?php

namespace common\services\mqtt\ValidateDevices;

class RelayProcessor implements DeviceInterface
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
     * relays_list - array current topics
     * relays      - models serialized in array
     */
    public function getTopics()
    {
        if (Cache::has($this->topicList)) {
            return $value = Cache::get($this->topicList);
        }

        $this->createDataset();
        $model = MqttRelay::all();
        return array_merge($model->pluck('topic')->toArray(), $model->pluck('check_topic')->toArray());
    }

    /**
     * @inheritDoc
     *
     * кэшируется модели реле и топики - топики это смесь проверочных топиков и топиков для комманд
     *
     * @return void
     */
    public function createDataset()
    {
        $model = MqttRelay::all();
        $topics = array_merge($model->pluck('topic')->toArray(), $model->pluck('check_topic')->toArray());
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
            $model = MqttRelay::all();
            self::process($model, $message);
        } else {
            self::process($model, $message);
        }
    }

    private function process($model, $message)
    {
        foreach ($model as $value) {
            if ($value['check_topic'] == $message->topic) {
                if (DeviceService::is_active($value) == false) {
                    break;
                }
                if (
                    ((string)$message->payload != (string)$value['check_command_on']) &&
                    ((string)$message->payload != (string)$value['check_command_off'])
                ) {
                    self::createDataset();
                    if (DeviceService::is_notifying($value)) {
                        $text = DataService::getTextNotify($value['message_warn'], (string)$message->payload);
                        DeviceService::SendNotify(new RelayNotify($text, $message));
                    }
                }
                break;
            }
        }
        foreach ($model as $value) {
            if ($value['topic'] == $message->topic) {
                if (DeviceService::is_active($value) == false) {
                    MqttRelay::logChangeState($message->topic, 'на деактивированный топик пришла комманда');
                    $notify = 'на деактивированный топик ' . $message->topic . ' пришла комманда {value}';
                    DeviceService::SendNotify(new RelayNotify($notify, $message));
                    break;
                }
                $payload = $message->payload;
                if ($value['command_on'] == $payload || $value['command_off'] == $payload) {
                    /** @var MqttRelay $relay */
                    $relay = MqttRelay::where('topic', $message->topic)->first();
                    $relay->last_command = $payload;
                    $relay->save();
                    if ($relay->type == 8) {
                        if ( $value['command_on'] == $payload ) {
                            MqttRelay::logChangeState($message->topic, 'включен - прямая команда');
                        }
                        if ( $value['command_off'] == $payload ) {
                            MqttRelay::logChangeState($message->topic, 'выключен - прямая команда');
                        }
                    }
                    self::createDataset();
                }
                break;
            }
        }
    }

}
