<?php


namespace console\controllers;

use common\services\MqttService;
use Yii;
use yii\console\Controller;

/**
 * Commands for MQTT sensors and posting to MQTT protocol
 */
ini_set('output_buffering','on');

class MqttController extends Controller
{
    public $host = '192.168.1.5';
    public $port = 1883;
    public $time = 60;
    private $client;
    private $isConnect = false;
    private $alarmTemper = 43;
    private $periodicTime = 1800; // период произведения анализа в методе process

    public function actionStart() {
        $service = MqttService::getInstance();
        $service->listen();
    }

    public function actionIndex() {
        $this->client = new \Mosquitto\Client();
        $this->client->connect($this->host, $this->port, 5);
        // https://mosquitto-php.readthedocs.io/en/latest/client.html#Mosquitto\Client::onConnect
        $this->client->onConnect(function ($rc){
            if($rc === 0){
                $this->isConnect = true;
            }
            else {
                $this->isConnect = false;
            }

        });
        $this->client->onDisconnect(function (){
            $this->isConnect = false;
        });
        register_shutdown_function([$this, 'disconnect']);

        $this->client->subscribe('#', 1);
        $this->client->onMessage([$this, 'process']);
        while(true) {
            $this->client->loop(10);
        }
    }

    public function process($message){
        echo $message->topic . ' ' . $message->payload . PHP_EOL;
    }

    public function listen()
    {
        $this->client->subscribe('#', 1);
        $this->client->onMessage([$this, 'process']);
        while(true) {
            $this->client->loop(10);
        }

    }

    /**
     * Sending data to topic on mqtt protocol
     * @param $topic $data
     * @return mixed
     */
    public function post($topic, $data)
    {
        $this->client->publish($topic, $data, 1, 0);
        return $data;
    }

    /**
     * Disconnect mqtt connection in lib
     */
    public function disconnect()
    {
        if($this->isConnect){
            $this->client->disconnect();
        }
    }
}