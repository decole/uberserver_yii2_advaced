<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "history_fire_secure_data".
 *
 * @property int $id
 * @property string $topic
 * @property string|null $payload
 * @property int $created_at
 */
class HistoryFireSecureData extends ActiveRecord
{
    public static function tableName()
    {
        return 'history_fire_secure_data';
    }

    public function rules()
    {
        return [
            [['topic', 'payload'], 'required'],
            [['created_at'], 'integer'],
            [['topic', 'payload'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => time(),
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic' => 'Topic',
            'payload' => 'Payload',
            'created_at' => 'Created At',
        ];
    }
}
