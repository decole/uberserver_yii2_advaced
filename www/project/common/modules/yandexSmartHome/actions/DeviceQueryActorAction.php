<?php

namespace common\modules\yandexSmartHome\actions;

use common\services\MqttService;

class DeviceQueryActorAction extends BaseAction
{
    public function run()
    {
        $request = json_decode(file_get_contents('php://input'));
        $state = $request->payload->devices[0]->capabilities[0]->state->value;
        $mqtt = new MqttService();

        if($state) {
            $mqtt->post('margulis/lamp01', 'on');
        } else {
            $mqtt->post('margulis/lamp01', 'off');
        }

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
                                "retrievable" => true,
                                "state" => [
                                    'instance' => 'on',
                                    "value" => $state,
                                    "action_result" => [
                                        "status" => "DONE"
                                    ],
                                ],
                            ]
                        ],
                    ]
                ]
            ]
        ];
    }
}