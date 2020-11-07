<?php

namespace common\models;

use common\services\mqtt\DeviceService;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "module_sensor".
 *
 * @property int $id
 * @property string $name
 * @property string $topic
 * @property string|null $message_info
 * @property string|null $message_ok
 * @property string|null $message_warn
 * @property int|null $to_condition
 * @property int|null $from_condition
 * @property int|null $type
 * @property int|null $location
 * @property int|null $notifying
 * @property int|null $active
 * @property int $created_at
 * @property int $updated_at
 */
class ModuleSensor extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_sensor';
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
            [['name', 'topic'], 'required'],
            [['type', 'location', 'to_condition', 'from_condition', 'notifying', 'active'], 'integer'],
            [['name', 'topic', 'message_info', 'message_ok', 'message_warn'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['topic'], 'unique'],
            [['notifying', 'active'], 'in', 'range' => [0, 1]],
            [['location'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => ModuleType::class, 'targetAttribute' => ['type' => 'id']],
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
            'topic' => 'Тема',
            'to_condition' => 'Значение от',
            'from_condition' => 'Значение до',
            'message_info' => 'Текст информации о датчике',
            'message_ok' => 'Текст успешного выполнения',
            'message_warn' => 'Текст ошибки',
            'type' => 'Тип датчика',
            'location' => 'Место нахождения датчика',
            'notifying' => 'Оповещение',
            'active' => 'Состояние',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function getLocations()
    {
        return $this->hasOne(Location::class, ['id' => 'location']);
    }

    public function getTypes()
    {
        return $this->hasOne(ModuleType::class, ['id' => 'type']);
    }

    public function getListLocations()
    {
        return ArrayHelper::map(Location::find()->asArray()->all(), 'id', 'location');
    }

    public function getListTypes()
    {
        return ArrayHelper::map(ModuleType::find()->asArray()->all(), 'id', 'name');
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
    }
}
