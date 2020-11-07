<?php

namespace common\models;

use common\services\mqtt\DeviceService;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "module_fire_system".
 *
 * @property int $id
 * @property string $name
 * @property string $topic
 * @property string|null $normal_condition значение нормы
 * @property string|null $alarm_condition значение сработки
 * @property string|null $message_info
 * @property string|null $message_ok
 * @property string|null $message_warn
 * @property int|null $type
 * @property int|null $location
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $notifying
 * @property int|null $active
 *
 * @property Location $location0
 * @property ModuleType $type0
 */
class ModuleFireSystem extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_fire_system';
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
            [['type', 'location', 'notifying', 'active'], 'integer'],
            [['name', 'topic', 'normal_condition', 'alarm_condition', 'message_info', 'message_ok', 'message_warn'], 'string', 'max' => 255],
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
            'normal_condition' => 'Значение нормы',
            'alarm_condition' => 'Значение сработки',
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

    /**
     * Gets query for [[Location0]].
     *
     * @return ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasOne(Location::class, ['id' => 'location']);
    }

    /**
     * Gets query for [[Type0]].
     *
     * @return ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasOne(ModuleType::class, ['id' => 'type']);
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
        Yii::$app->cache->delete($service->fireSecure_model);
        Yii::$app->cache->delete($service->fireSecure_list);
    }
}
