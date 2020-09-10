<?php

namespace App\Services;

use common\services\mqtt\DeviceService;
use Mosquitto\Client;
use Yii;

final class MqttService
{
    // https://mosquitto-php.readthedocs.io/en/latest/client.html#Mosquitto\Client::onConnect

    /**
     * @var
     */
    private $host;

    /**
     * @var
     */
    private $port;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var bool
     */
    private $isConnect = false;

    /**
     * @var DeviceService
     */
    private $device;

    /**
     * @var array
     */
    protected static $instances;
    /**
     * @var \yii\caching\CacheInterface
     */
    private $cache;

    public static function getInstance(): self
    {
        $class = static::class;

        if (!isset(static::$instances[$class])) {
            static::$instances[$class] = Yii::createObject(static::class);
        }

        return static::$instances[$class];
    }

    public function __construct()
    {
        $this->host = Yii::$app->params['MQTT_SERVER_IP'];
        $this->port = Yii::$app->params['MQTT_SERVER_PORT'];
        $this->client = new Client();
        $this->client->connect($this->host, $this->port, 5);

        $this->client->onConnect(function ($rc) {
            if ($rc === 0) {
                $this->isConnect = true;
            } else {
                $this->isConnect = false;
            }

        });
        $this->client->onDisconnect(function () {
            $this->isConnect = false;
        });
        register_shutdown_function([$this, 'disconnect']);

        $this->device = new DeviceService();

        $this->cache = Yii::$app->cache;
    }

    /**
     * Service initializing
     */
    public function listen()
    {
        $this->client->subscribe('#', 1);
        $this->client->onMessage([$this, 'process']);
        while (true) {
            $this->client->loop(5);
        }
    }

    /**
     * Disconnect mqtt connection in lib
     */
    public function disconnect()
    {
        if ($this->isConnect) {
            $this->client->disconnect();
        }
    }

    /**
     * main process compute mqtt messages
     *
     * @param $message
     * @return bool|void
     */
    public function process($message)
    {
        $this->cache->set($message->topic, $message->payload, 60);

        if ($message->topic == 'greenhouse/temperature') {
            self::saveDB($message);
            return true;
        }

        $this->device->route($message);
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
     * Соханение в БД таблице истории сообщений
     *
     * @param $message
     */
    private function saveDB($message)
    {
        /** @var MqttHistory $model */
        $model = new MqttHistory();
        $model->topic = $message->topic;
        $model->payload = $message->payload;
        $model->save();
    }

}
