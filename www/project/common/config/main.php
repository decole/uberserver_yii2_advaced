<?php

use yii\mutex\MysqlMutex;
use yii\queue\db\Queue;
use yii\queue\LogBehavior;
use yii\queue\serializers\JsonSerializer;

return [
    'timeZone' => 'Europe/Volgograd',
    'bootstrap' => [
        'queue',
        'log',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => [
                'hostname' => 'redis',
                'port' => 6379,
                'database' => 0,
            ],
        ],
        'request' => [
            'csrfCookie' => [
                'httpOnly' => true,
                'secure' => true,
            ],
        ],
        'cookies' => [
            'class' => 'yii\web\Cookie',
            'httpOnly' => true,
            'secure' => true,
        ],
        'session' => [
            'cookieParams' => [
                'httpOnly' => true,
                'secure' => true,
            ],
        ],
        'queue' => [
            'as log' => LogBehavior::class,
            'class' => Queue::class,
            'db' => 'db',
            'serializer' => JsonSerializer::class,
            'tableName' => 'queue',
            'channel' => 'default',
            'mutex' => MysqlMutex::class,
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'redis',
            'port' => 6379,
            'database' => 0,
        ],
        'eventManager' => [
            'class' => 'common\components\EventManager',
        ],
    ],
    'modules' => [
        'alice-smart-home' => [
            'class' => 'common\modules\yandexSmartHome\Module',
        ],
        'alice-skill' => [
            'class' => 'common\modules\yandexSkill\Module',
        ],
    ],
];
