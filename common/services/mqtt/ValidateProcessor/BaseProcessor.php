<?php

namespace common\services\mqtt\ValidateProcessor;

use backend\jobs\TelegramNotifyJob;
use Throwable;
use yii\helpers\ArrayHelper;
use Yii;

class BaseProcessor implements DeviceInterface
{
    /**
     * @var string
     */
    public $topicList;
    /**
     * @var string
     */
    public $topicModel;

    /**
     * @var
     */
    public $validateForm;

    /**
     * @var
     */
    public $validateModel;

    /**
     * @var \yii\caching\CacheInterface
     */
    protected $cache;

    public function __construct($topicList, $topicsModel, $validateModel, $validateForm)
    {
        $this->cache = Yii::$app->cache;
        $this->topicList = $topicList;
        $this->topicModel = $topicsModel;
        $this->validateModel = $validateModel;
        $this->validateForm = $validateForm;
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
            $model = $this->validateModel::find()
                ->orderBy(['id'=>SORT_ASC])
                ->all();

            return ArrayHelper::map($model, 'topic', 'name');
        });
    }

    /**
     * @param $topic
     * @return array|null
     */
    public function getSensorModel($topic)
    {
        $models = $this->cache->getOrSet($this->topicModel, function () {
            return $this->validateModel::find()
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
        $models = $this->cache->getOrSet($this->topicModel, function () {
            return $this->validateModel::find()
                ->orderBy(['id'=>SORT_ASC])
                ->asArray()
                ->all();
        });

        $this->cache->set($this->topicModel, $models);
        $this->cache->set($this->topicList, self::getTopics());
    }

    /**
     * @inheritDoc
     */
    public function deviceValidate($message)
    {
        try {
            echo $message->topic . PHP_EOL;
            $form = Yii::createObject($this->validateForm, [$message->topic, $message->payload, $this]);
            if ($form->validate()) {
                return;
            }

            $error = '';
            foreach ($form->getErrors('payload') as $value) {
                $error .= $value . "\n";
            }

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
