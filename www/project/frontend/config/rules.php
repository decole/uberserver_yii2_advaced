<?php
return [
    '' => 'site/index',

    'api/alice' => 'alice-skill/main/index',

    'api/alice_home' => 'alice-smart-home/main/index',
    'api/alice_home/v1.0' => 'alice-smart-home/main/index',
    'api/alice_home/v1.0/user/unlink' => 'alice-smart-home/main/unlink',
    'api/alice_home/v1.0/user/devices' => 'alice-smart-home/main/devices',
    'api/alice_home/v1.0/user/devices/query' => 'alice-smart-home/main/devices-query',
    'api/alice_home/v1.0/user/devices/action' => 'alice-smart-home/main/devices-action',

    '<action:\w+>/' => '<controller>/<action>',
];

//    /**
//     * api/alice_home - Яндекс Умный Дом
//     *  Ресурс	                    Описание	                                    Метод
//     *  /v1.0/	                    Проверка доступности Endpoint URL провайдера	HEAD
//     *  /v1.0/user/unlink	            Оповещение о разъединении аккаунтов	            POST
//     *  /v1.0/user/devices	        Информация об устройствах пользователя	        GET
//     *  /v1.0/user/devices/query	    Информация о состояниях устройств пользователя	POST
//     *  /v1.0/user/devices/action	    Изменение состояния у устройств                 POST
//     */
