<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "module_sensor".
 *
 * @property int $id
 * @property string $name
 * @property string $topic
 * @property string|null $payload
 * @property string|null $message_info
 * @property string|null $message_ok
 * @property string|null $message_warn
 * @property int|null $type
 * @property int|null $location
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
    public function rules()
    {
        return [
            [['name', 'topic', 'created_at', 'updated_at'], 'required'],
            [['type', 'location', 'created_at', 'updated_at'], 'integer'],
            [['name', 'topic', 'message_info', 'message_ok', 'message_warn'], 'string', 'max' => 255],
            [['payload'], 'string', 'max' => 32],
            [['name'], 'unique'],
            [['topic'], 'unique'],
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
            'payload' => 'Payload',
            'message_info' => 'Message Info',
            'message_ok' => 'Message Ok',
            'message_warn' => 'Message Warn',
            'type' => 'Type',
            'location' => 'Location',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
