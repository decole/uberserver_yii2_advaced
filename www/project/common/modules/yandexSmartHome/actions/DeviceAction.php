<?php

namespace common\modules\yandexSmartHome\actions;

class DeviceAction extends BaseAction
{
    public function run()
    {
        return [
            "request_id" => $this->request_id,
            "payload" => [
                "user_id" => "decole2014",
                "devices" => [
                    [
                        "id" =>  '1',
                        "name" =>  'switcher1',
                        "type" =>  'devices.types.switch',
                        "capabilities" => [
                            [
                                "type" => "devices.capabilities.on_off",
                                "retrievable" => true
                            ]
                        ],

                    ]
                ]
            ]
        ];
    }
}