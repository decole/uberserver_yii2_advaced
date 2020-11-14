<?php

namespace common\tests\unit\services;

use common\forms\FireSecureValidateForm;
use common\forms\LeakageValidateForm;
use common\forms\RelayValidateForm;
use common\forms\SecureValidateForm;
use common\forms\SensorValidateForm;
use Yii;

/**
 * Login form test
 */
class MqttSeviceTest extends \Codeception\Test\Unit
{
    protected $tester;

    public function testSensorTopic()
    {
        $message = new class {
            public string $topic = 'sensor/topic';
            public float $payload = 45.1;
        };

        $processor = new class() {
            public function getSensorModel()
            {
                return [
                    'active' => 1,
                    'notifying' => 1,
                    'from_condition' => 50,
                    'to_condition' => 10,
                    'message_warn' => '{value} wqweqweqwe',
                ];
            }
        };

        $form = Yii::createObject(SensorValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();

        $this->assertEquals(true, $validate);
        $this->assertEquals('sensor/topic', $message->topic);
        $this->assertEquals(45.1, $message->payload);
        $this->assertEquals($message->topic, $form->topic);
        $this->assertEquals($message->payload, $message->payload);
        $this->assertIsFloat($message->payload);

        // за пределами отсечки
        $message = new class {
            public string $topic = 'sensor/topic';
            public float $payload = 90;
        };

        $form = Yii::createObject(SensorValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(false, $validate);
        $this->assertEquals($message->payload, $message->payload);
    }

    public function testLeakageTopic() {
        $message = new class {
            public string $topic = 'sensor/topic';
            public int $payload = 1;
        };

        $processor = new class() {
            public function getSensorModel()
            {
                return [
                    'active' => 1,
                    'notifying' => 1,
                    'check_up' => 1,
                    'check_down' => 0,
                    'message_warn' => '{value} wqweqweqwe',
                ];
            }
        };

        $form = Yii::createObject(LeakageValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(false, $validate);
        $this->assertEquals('1 wqweqweqwe', $form->errors['payload'][0]);
    }

    public function testRelayTopic() {
        $message = new class {
            public string $topic = 'sensor/topic';
            public string $payload = 'on';
        };

        $processor = new class() {
            public function getSensorModel()
            {
                return [
                    'active' => 1,
                    'notifying' => 1,
                    'topic' => 'sensor/topic',
                    'check_topic' => 'sensor/check/topic',
                    'command_on' => 'on',
                    'command_off' => 'off',
                    'check_command_on' => 1,
                    'check_command_off' => 0,
                    'name' => 'relay 1',
                    'message_warn' => '{value} wqweqweqwe',
                ];
            }
        };

        $form = Yii::createObject(RelayValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(true, $validate);
        $this->assertEquals([], $form->errors);



        $message = new class {
            public string $topic = 'sensor/topic';
            public string $payload = '';
        };

        $form = Yii::createObject(RelayValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(false, $validate);
        $this->assertEquals('Payload cannot be blank.', $form->errors['payload'][0]);


        $message = new class {
            public string $topic = 'sensor/check/topic';
            public string $payload = '1';
        };

        $form = Yii::createObject(RelayValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(true, $validate);
        $this->assertEquals([], $form->errors);



        $message = new class {
            public string $topic = 'sensor/check/topic';
            public string $payload = '';
        };

        $form = Yii::createObject(RelayValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(false, $validate);
        $this->assertEquals('Payload cannot be blank.', $form->errors['payload'][0]);
    }

    public function testFireSecureTopic() {
        $message = new class {
            public string $topic = 'sensor/topic';
            public int $payload = 1;
        };

        $processor = new class() {
            public function getSensorModel()
            {
                return [
                    'active' => 1,
                    'notifying' => 1,
                    'alarm_condition' => 1,
                    'message_warn' => '{value} wqweqweqwe',
                ];
            }
        };

        $form = Yii::createObject(FireSecureValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(false, $validate);
        $this->assertEquals('1 wqweqweqwe', $form->errors['payload'][0]);
    }

    public function testSecureTopic() {
        $message = new class {
            public string $topic = 'sensor/topic';
            public int $payload = 1;
        };

        $processor = new class() {
            public function getSensorModel()
            {
                return [
                    'active' => 1,
                    'notifying' => 1,
                    'trigger' => 1,
                    'alarm_condition' => 0,
                    'message_warn' => '{value} wqweqweqwe',
                ];
            }
        };

        $form = Yii::createObject(SecureValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(true, $validate);
        $this->assertEquals([], $form->errors);

        $processor = new class() {
            public function getSensorModel()
            {
                return [
                    'active' => 1,
                    'notifying' => 1,
                    'trigger' => 1,
                    'alarm_condition' => 1,
                    'message_warn' => '{value} wqweqweqwe',
                ];
            }
        };

        $form = Yii::createObject(SecureValidateForm::class, [
            'topic' => $message->topic,
            'payload' => $message->payload,
            'processor' => $processor,
        ]);

        $validate = $form->validate();
        $this->assertEquals(false, $validate);
        $this->assertEquals('1 wqweqweqwe', $form->errors['payload'][0]);
    }

}
