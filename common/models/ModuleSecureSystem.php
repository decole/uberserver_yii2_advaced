<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "module_secure_system".
 *
 * @property int $id
 * @property string $name
 * @property string $topic
 * @property string|null $normal_condition значение нормы
 * @property string|null $alarm_condition значение сработки
 * @property int|null $trigger
 * @property string $current_command
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
 * @property Location $locations
 * @property ModuleType $types
 */
class ModuleSecureSystem extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_secure_system';
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
            [['name', 'topic', 'current_command'], 'required'],
            [['trigger', 'type', 'location', 'notifying', 'active'], 'integer'],
            [['name', 'topic', 'normal_condition', 'alarm_condition', 'current_command', 'message_info', 'message_ok', 'message_warn'], 'string', 'max' => 255],
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
            'trigger' => 'Взведено',
            'current_command' => 'Текущая команда',
            'message_info' => 'Текст информации о датчике',
            'message_ok' => 'Текст успешного выполнения',
            'message_warn' => 'Текст ошибки',
            'type' => 'Тип модуля',
            'location' => 'Локация',
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
}
