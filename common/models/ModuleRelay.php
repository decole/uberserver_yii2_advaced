<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "module_relay".
 *
 * @property int $id
 * @property string $name
 * @property string $topic
 * @property string|null $check_topic
 * @property string $command_on
 * @property string $command_off
 * @property string|null $check_command_on
 * @property string|null $check_command_off
 * @property string|null $last_command
 * @property string|null $message_info
 * @property string|null $message_ok
 * @property string|null $message_warn
 * @property int|null $type
 * @property int|null $location
 * @property int $created_at
 * @property int $updated_at
 */
class ModuleRelay extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_relay';
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
            [['name', 'topic', 'command_on', 'command_off'], 'required'],
            [['type', 'location'], 'integer'],
            [['name', 'topic', 'check_topic', 'command_on', 'command_off', 'check_command_on', 'check_command_off', 'last_command', 'message_info', 'message_ok', 'message_warn'], 'string', 'max' => 255],
            [['name', 'topic', 'check_topic'], 'unique'],
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
            'check_topic' => 'Проверочная тема',
            'command_on' => 'Команда On',
            'command_off' => 'Команда Off',
            'check_command_on' => 'Проверочная команда On',
            'check_command_off' => 'Проверочная команда Off',
            'last_command' => 'Последняя команда',
            'message_info' => 'Текст информации о датчике',
            'message_ok' => 'Текст успешного выполнения',
            'message_warn' => 'Текст ошибки',
            'type' => 'Тип датчика',
            'location' => 'Место нахождения датчика',
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
}
