<?php

namespace common\services\mqtt;

use common\services\mqtt\ValidateDevices\FireSecureProcessor;
use common\services\mqtt\ValidateDevices\RelayProcessor;
use common\services\mqtt\ValidateDevices\SecureProcessor;
use common\services\mqtt\ValidateDevices\SensorProcessor;
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

    /**
     * @var string
     */
    protected $sensor_list = 'sensor_list';

    /**
     * @var string
     */
    protected $sensor_model = 'sensors';

    /**
     * @var RelayProcessor
     */
    private $relay;
    protected $relay_list = 'relay_list';
    protected $relay_model = 'relays';

    /**
     * @var SecureProcessor
     */
    private $secure;
    protected $secure_list = 'secure_list';
    protected $secure_model = 'secures';
    public static $secure_cache_model = 'secures';

    /**
     * @var FireSecureProcessor
     */
    private $fireSecure;
    protected $fireSecure_list = 'fire_secures_list';
    protected $fireSecure_model = 'fire_secures';


    public function __construct()
    {
        $this->sensor     = new SensorProcessor($this->sensor_list, $this->sensor_model);
//        $this->relay      = new RelayProcessor($this->relay_list, $this->relay_model);
//        $this->secure     = new SecureProcessor($this->secure_list, $this->secure_model);
//        $this->fireSecure = new FireSecureProcessor($this->fireSecure_list, $this->fireSecure_model);
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
$i=0;
        switch ($i) {
            case 0:
                echo "i равно 0";
                break;
            case 1:
                echo "i равно 1";
                break;
            case 2:
                echo "i равно 2";
                break;
        }
        
//            $ar = [
//                $this->sensor,
//                $this->relay,
//                $this->secure,
//                $this->fireSecure
//            ];
//            foreach ($ar as $value) {
//                if ( in_array($message->topic, $value->getTopics()) ) {
//                    break;
//                }
//            }

//            if (in_array($message->topic, $this->sensor->getTopics())) {
//                return $this->sensor->deviceValidate($message);
//            }
            // Todo fix it
            /*
            if (in_array($message->topic, $this->relay->getTopics())) {
                return $this->relay->deviceValidate($message);
            }
            if (in_array($message->topic, $this->secure->getTopics())) {
                return $this->secure->deviceValidate($message);
            }
            if (in_array($message->topic, $this->fireSecure->getTopics())) {
                return $this->fireSecure->deviceValidate($message);
            }
            */
    }

    /**
     * Проверка возможности отправки нотификации
     *
     * @param $value
     * @return bool
     */
    public static function is_notifying($value)
    {
        return $value['notifying'];
    }

    /**
     * Проверка активности топиков из БД
     *
     * @param $value
     * @return bool
     */
    public static function is_active($value)
    {
        return $value['active'];
    }

    /**
     * Отправка уведомлений
     *
     * @param \Illuminate\Notifications\Notification $object
     */
    public static function SendNotify(\Illuminate\Notifications\Notification $object)
    {
        /** @var SensorNotify $note */
        $note = $object;
        $user = User::where('name', 'decole')->first();
        $is_double = false;
        foreach ($user->unreadNotifications as $notification) {
            echo var_export($notification->data['message'], true) . ' - ';
            echo var_export($note->message, true) . PHP_EOL;
            if ($notification->data['message'] == $note->message) {
                $startTime = Carbon::parse($notification->created_at);
                $finishTime = Carbon::now();
                if ($finishTime->diffInSeconds($startTime) < 30) {
                    $is_double = true;
                }
                break;
            }
        }
        if (!$is_double) {
            echo 'sending message, not find double notify'.PHP_EOL;
            Notification::send($user, $object);
        }
    }

}
