<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

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
    public function rules()
    {
        return [
            [['name', 'topic', 'command_on', 'command_off', 'created_at', 'updated_at'], 'required'],
            [['type', 'location', 'created_at', 'updated_at'], 'integer'],
            [['name', 'topic', 'check_topic', 'command_on', 'command_off', 'check_command_on', 'check_command_off', 'last_command', 'message_info', 'message_ok', 'message_warn'], 'string', 'max' => 255],
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
            'check_topic' => 'Check Topic',
            'command_on' => 'Command On',
            'command_off' => 'Command Off',
            'check_command_on' => 'Check Command On',
            'check_command_off' => 'Check Command Off',
            'last_command' => 'Last Command',
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
