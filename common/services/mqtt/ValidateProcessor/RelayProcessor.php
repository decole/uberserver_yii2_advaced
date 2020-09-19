<?php

namespace common\services\mqtt\ValidateProcessor;

use common\forms\RelayValidateForm;
use common\models\ModuleRelay;
use yii\helpers\ArrayHelper;

class RelayProcessor extends BaseProcessor
{
    public function __construct($topicList, $topicsModel)
    {
        parent::__construct($topicList, $topicsModel, ModuleRelay::class, RelayValidateForm::class);
    }

    /**
     * @return array|mixed
     */
    public function getTopics()
    {
        return $this->cache->getOrSet($this->topicList, function () {
            $model = $this->validateModel::find()
                ->orderBy(['id'=>SORT_ASC])
                ->all();

            $topics = ArrayHelper::map($model, 'topic', 'name');
            $checkTopics = ArrayHelper::map($model, 'check_topic', 'name');

            return array_merge($topics, $checkTopics);
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
            if ($model['topic'] == $topic || $model['check_topic'] == $topic) {
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
}
