<?php

use yii\mutex\MysqlMutex;
use yii\queue\db\Queue;
use yii\queue\LogBehavior;

return [
    'bootstrap' => [
        'queue',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'queue' => [
            'as log' => LogBehavior::class,
            'class' => Queue::class,
            'db' => 'db',

            'tableName' => 'queue',
            'channel' => 'default',
            'mutex' => MysqlMutex::class,
        ],
    ],
    'modules' => [
        'alice_smart_home' => [
            'class' => 'common\modules\yandexSmartHome\Module',
        ]
    ],
];
