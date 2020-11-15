<?php

use common\eventHandlers\NotificationHandler;
use common\events\Event;

return [
    Event::EVENT_SEND_ALARM_NOTIFICATION => [
        [NotificationHandler::class, 'sendSensorNotify'],
    ],
];
