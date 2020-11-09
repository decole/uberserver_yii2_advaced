<?php

namespace common\models;

use common\services\mqtt\DeviceService;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $location
 */
class Location extends ActiveRecord
{
    public static function tableName()
    {
        return 'location';
    }

    public function rules()
    {
        return [
            [['location'], 'required'],
            [['location'], 'string', 'max' => 255],
            [['location'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Локация',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        self::updateCache();
    }

    public function afterDelete()
    {
        parent::afterDelete();
        self::updateCache();
    }

    private static function updateCache(): void
    {
        $service = DeviceService::getInstance();

        Yii::$app->cache->delete($service->sensor_model);
        Yii::$app->cache->delete($service->sensor_list);

        Yii::$app->cache->delete($service->relay_model);
        Yii::$app->cache->delete($service->relay_list);

        Yii::$app->cache->delete($service->leakage_model);
        Yii::$app->cache->delete($service->leakage_list);

        Yii::$app->cache->delete($service->secure_model);
        Yii::$app->cache->delete($service->secure_list);

        Yii::$app->cache->delete($service->fireSecure_model);
        Yii::$app->cache->delete($service->fireSecure_list);
    }
}
