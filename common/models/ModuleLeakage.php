<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "module_leakage".
 *
 * @property int $id
 * @property string $name
 * @property string $topic
 * @property string $check_up
 * @property string $check_down
 * @property string|null $message_info
 * @property string|null $message_ok
 * @property string|null $message_warn
 * @property int|null $type
 * @property int|null $location
 * @property int|null $notifying
 * @property int|null $active
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Location $location0
 * @property ModuleType $type0
 */
class ModuleLeakage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'module_leakage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'topic', 'check_up', 'check_down', 'created_at', 'updated_at'], 'required'],
            [['type', 'location', 'notifying', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'topic', 'check_up', 'check_down', 'message_info', 'message_ok', 'message_warn'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['topic'], 'unique'],
            [['location'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => ModuleType::className(), 'targetAttribute' => ['type' => 'id']],
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
            'check_up' => 'Check Up',
            'check_down' => 'Check Down',
            'message_info' => 'Message Info',
            'message_ok' => 'Message Ok',
            'message_warn' => 'Message Warn',
            'type' => 'Type',
            'location' => 'Location',
            'notifying' => 'Notifying',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Location0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation0()
    {
        return $this->hasOne(Location::className(), ['id' => 'location']);
    }

    /**
     * Gets query for [[Type0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(ModuleType::className(), ['id' => 'type']);
    }
}
