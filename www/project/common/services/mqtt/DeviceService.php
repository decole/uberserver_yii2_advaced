<?php

namespace common\services\mqtt;

use common\services\mqtt\ValidateProcessor\LeakageProcessor;
use common\services\mqtt\ValidateProcessor\SensorProcessor;
use common\services\mqtt\ValidateProcessor\RelayProcessor;
use common\services\mqtt\ValidateProcessor\SecureProcessor;
use common\services\mqtt\ValidateProcessor\FireSecureProcessor;
use common\traits\instance;

final class DeviceService
{
    use instance;

    /**
     * @var array
     */
    protected static $instances;

    /**
     * @var SensorProcessor
     */
    private $sensor;
    public $sensor_list = 'sensor_list';
    public $sensor_model = 'sensors';

    private $leakage;
    public $leakage_list = 'leakage_list';
    public $leakage_model = 'leakage';

    /**
     * @var RelayProcessor
     */
    private $relay;
    public $relay_list = 'relay_list';
    public $relay_model = 'relays';

    /**
     * @var SecureProcessor
     */
    private $secure;
    public $secure_list = 'secure_list';
    public $secure_model = 'secures';
    public static $secure_cache_model = 'secures';

    /**
     * @var FireSecureProcessor
     */
    private $fireSecure;
    public $fireSecure_list = 'fire_secures_list';
    public $fireSecure_model = 'fire_secures';


    public function __construct()
    {
        $this->sensor     = new SensorProcessor($this->sensor_list, $this->sensor_model);
        $this->leakage    = new LeakageProcessor($this->leakage_list, $this->leakage_model);
        $this->relay      = new RelayProcessor($this->relay_list, $this->relay_model);
        $this->fireSecure = new FireSecureProcessor($this->fireSecure_list, $this->fireSecure_model);
        $this->secure     = new SecureProcessor($this->secure_list, $this->secure_model);
    }

    /**
     * @param $message
     * @return bool|void
     */
    public function route($message)
    {
        if ($message->topic === null || $message->payload === null) {
            return false;
        }

        switch ($message->topic) {
            case $this->sensor->isSensor($message->topic):
                $this->sensor->deviceValidate($message);

                break;
            case $this->leakage->isSensor($message->topic):
                $this->leakage->deviceValidate($message);

                break;
            case $this->relay->isSensor($message->topic):
                $this->relay->deviceValidate($message);

                break;
            case $this->fireSecure->isSensor($message->topic):
                $this->fireSecure->deviceValidate($message);

                break;
            case $this->secure->isSensor($message->topic):
                $this->secure->deviceValidate($message);

                break;
            default:
                // вывод топиков, которые не были обработаны валидаторами выше
                echo '. ' . $message->topic . ' ' . $message->payload . PHP_EOL;

                break;
        }
    }
}
