<?php

namespace common\services\mqtt\ValidateProcessor;

use backend\jobs\TelegramNotifyJob;
use common\forms\LeakageValidateForm;
use common\models\ModuleLeakage;
use Throwable;
use yii\helpers\ArrayHelper;
use Yii;

class LeakageProcessor implements DeviceInterface
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
            $model = ModuleLeakage::find()
                ->orderBy(['id'=>SORT_ASC])
                ->all();

            return ArrayHelper::map($model, 'topic', 'name');
        });
    }

    public function getSensorModel($topic)
    {
        $models = $this->cache->getOrSet($this->topicModel, function () {
            return ModuleLeakage::find()
                ->orderBy(['id'=>SORT_ASC])
                ->asArray()
                ->all();
        });

        foreach ($models as $model) {
            if ($model['topic'] == $topic) {
               return $model;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     * @return void
     */
    public function createDataset()
    {
        $model = ModuleLeakage::find()
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
        try {
            /** @var LeakageValidateForm $form */
            echo $message->topic . PHP_EOL;
            $form = Yii::createObject(LeakageValidateForm::class, [$message->topic, $message->payload, $this]);
            if ($form->validate()) {
                return;
            }

            $error = '';
            foreach ($form->getErrors('payload') as $value) {
                $error .= $value . "\n";
            }

            echo ' ' . $error . PHP_EOL;
            Yii::$app->queue->push(new TelegramNotifyJob([
                'message' => $error,
            ]));
        } catch (Throwable $e) {
            Yii::error($e->getMessage());
        }
    }

    public function isSensor($topic)
    {
        return array_key_exists($topic, $this->getTopics()) ;
    }
}
