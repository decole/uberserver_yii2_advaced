<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class ModuleFireSystem extends ActiveRecord
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
    public function rules()
    {
        return [
            [['name', 'topic', 'created_at', 'updated_at'], 'required'],
            [['type', 'location', 'created_at', 'updated_at', 'notifying', 'active'], 'integer'],
            [['name', 'topic', 'normal_condition', 'alarm_condition', 'message_info', 'message_ok', 'message_warn'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['topic'], 'unique'],
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
            'name' => 'Name',
            'topic' => 'Topic',
            'normal_condition' => 'значение нормы',
            'alarm_condition' => 'значение сработки',
            'message_info' => 'Message Info',
            'message_ok' => 'Message Ok',
            'message_warn' => 'Message Warn',
            'type' => 'Type',
            'location' => 'Location',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'notifying' => 'Notifying',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[Location0]].
     *
     * @return ActiveQuery
     */
    public function getLocation0()
    {
        return $this->hasOne(Location::class, ['id' => 'location']);
    }

    /**
     * Gets query for [[Type0]].
     *
     * @return ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(ModuleType::class, ['id' => 'type']);
    }
}
