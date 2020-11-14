<?php

namespace common\components;

use Yii;
use yii\base\Component;

class EventManager extends Component
{
    /*
     >> on component or module
     private function init()
    {
        $handlers = return [
            Event::EVENT_GET_SOME_ACTION => [
                [SomeHandler::class, 'getSomeActionEvent'],
            ],
            ...
        ];

        $eventManager = new EventManager();
        $this->registerHandlers($handlers);
    }
     */

    /**
     * Регистрирует обработчики
     *
     * @param array $handlers
     */
    public function registerHandlers($handlers): void
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