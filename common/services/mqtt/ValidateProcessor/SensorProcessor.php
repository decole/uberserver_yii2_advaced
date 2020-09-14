<?php

namespace common\services\mqtt\ValidateProcessor;

use common\forms\SensorValidateForm;
use common\models\ModuleSensor;
use SebastianBergmann\CodeCoverage\Report\PHP;
use yii\helpers\ArrayHelper;
use Yii;

class SensorProcessor implements DeviceInterface
{
    /**
     * @var string
     */
    public $topicList;
    /**
     * @var string
     */
    public $topicModel;

    protected $cache;

    public function __construct($topicList, $topicsModel)
    {
        $this->cache = Yii::$app->cache;
        $this->topicList = $topicList;
        $this->topicModel = $topicsModel;
        $this->createDataset();
    }

    /**
     * @inheritDoc
     *
     * sensor_list - array current topics
     * sensors     - models serialized in array
     */
    public function getTopics()
    {
        return $this->cache->getOrSet($this->topicList, function () {
            $model = ModuleSensor::find()
                ->orderBy(['id'=>SORT_ASC])
                ->all();

            return ArrayHelper::map($model, 'topic', 'name');
        });
    }

    /**
     * @inheritDoc
     * @return void
     */
    public function createDataset()
    {
        $model = ModuleSensor::find()
            ->orderBy(['id'=>SORT_ASC])
            ->all();
        $topics = ArrayHelper::map($model, 'topic', 'name');

        $this->cache->set($this->topicModel, $model);
        $this->cache->set($this->topicList, $topics);
    }

    /**
     * @inheritDoc
     */
    public function deviceValidate($message)
    {
        if (!Cache::has($this->topicModel) || is_null(Cache::get($this->topicModel))) {
            self::createDataset();
        }
        $model = Cache::get($this->topicModel);
        if (empty($model)) {
            self::createDataset();
            $model = MqttSensor::all();
            self::process($model, $message);
        } else {
            self::process($model, $message);
        }
    }

    private function process($model, $message)
    {
        foreach ($model as $value) {
            if ($value['topic'] == $message->topic) {
                if (
                    ($value['from_condition'] && (integer)$message->payload < (integer)$value['from_condition']) ||
                    ($value['to_condition'] && (integer)$message->payload > (integer)$value['to_condition']) ||
                    ($value['type'] == 3 && (integer)$value['to_condition'] !== (integer)$message->payload) // leakage
                ) {
                    $text = DataService::getTextNotify($value['message_warn'], (string)$message->payload);
                    DeviceService::SendNotify(new SensorNotify($text, $message));
                }
                break;
            }
        }
    }

    public function isSensor($topic)
    {
        return array_key_exists($topic, $this->getTopics()) ;
    }

    public function validate($message)
    {
        /** @var SensorValidateForm $form */
        echo $message->topic . PHP_EOL;
        $form = Yii::createObject(SensorValidateForm::class, [$message->topic,$message->payload]);
        if ($form->validate()) {
            return;
        }
    }
}
