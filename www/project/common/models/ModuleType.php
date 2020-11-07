<?php

namespace common\models;

use common\services\mqtt\DeviceService;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "module_type".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 */
class ModuleType extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_type';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
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
