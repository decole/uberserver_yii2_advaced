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
                echo $message->topic . ' ' . $message->payload . PHP_EOL;
                $this->secure->deviceValidate($message);

                break;
            default:
                echo '.' . PHP_EOL;

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

//    /**
//     * Проверка возможности отправки нотификации
//     *
//     * @param $value
//     * @return bool
//     */
//    public static function is_notifying($value)
//    {
//        return $value['notifying'];
//    }

//    /**
//     * Проверка активности топиков из БД
//     *
//     * @param $value
//     * @return bool
//     */
//    public static function is_active($value)
//    {
//        return $value['active'];
//    }

//    /**
//     * Отправка уведомлений
//     *
//     * @param \Illuminate\Notifications\Notification $object
//     */
//    public static function SendNotify(\Illuminate\Notifications\Notification $object)
//    {
//        /** @var SensorNotify $note */
//        $note = $object;
//        $user = User::where('name', 'decole')->first();
//        $is_double = false;
//        foreach ($user->unreadNotifications as $notification) {
//            echo var_export($notification->data['message'], true) . ' - ';
//            echo var_export($note->message, true) . PHP_EOL;
//            if ($notification->data['message'] == $note->message) {
//                $startTime = Carbon::parse($notification->created_at);
//                $finishTime = Carbon::now();
//                if ($finishTime->diffInSeconds($startTime) < 30) {
//                    $is_double = true;
//                }
//                break;
//            }
//        }
//        if (!$is_double) {
//            echo 'sending message, not find double notify'.PHP_EOL;
//            Notification::send($user, $object);
//        }
//    }
}
