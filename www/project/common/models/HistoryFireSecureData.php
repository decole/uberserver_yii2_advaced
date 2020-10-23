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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history_fire_secure_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topic', 'payload'], 'required'],
            [['created_at'], 'integer'],
            [['topic', 'payload'], 'string', 'max' => 255],
        ];
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
                'updatedAtAttribute' => false,
                'value' => time(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
