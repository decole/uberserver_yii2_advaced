<?php

namespace common\components;

use Yii;
use yii\base\Component;

class EventManager extends Component
{
//    public function init()
//    {
//        var_dump('123333');
////        $handlers = [
////            Event::EVENT_SEND_ALARM_NOTIFICATION => [
////                [NotificationHandler::class, 'sendSensorNotify'],
////            ],
////        ];
////        $this->registerHandlers($handlers);
//        parent::init();
//    }

//    public function __construct($config = [])
//    {
//        var_dump('123');
//        exit();
//        $handlers = [
//            Event::EVENT_SEND_ALARM_NOTIFICATION => [
//                [NotificationHandler::class, 'sendSensorNotify'],
//            ],
//        ];
//        $this->registerHandlers($handlers);
//
//        parent::__construct($config);
//    }


    /**
     * Регистрирует обработчики
     *
     * @param array $handlers
     */
    public function registerHandlers(array $handlers): void
    {
        foreach ($handlers as $event => $callbacks) {
            if (!is_array($callbacks)) {
                $callbacks = [$callbacks];
            }
            foreach ($callbacks as $callback) {
                Yii::$app->on($event, $callback);
            }
        }
    }
}