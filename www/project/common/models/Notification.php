<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $data
 * @property int|null $read_at
 * @property int $created_at
 * @property int $updated_at
 */
class Notification extends ActiveRecord
{
    const FIELD_DATA_LIMIT = 1000;

    public static function tableName()
    {
        return 'notification';
    }

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

    public function rules()
    {
        return [
            [['read_at', 'created_at', 'updated_at'], 'integer'],
            [['type'], 'string', 'max' => 100],
            [['data'], 'string', 'max' => self::FIELD_DATA_LIMIT],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тиа',
            'data' => 'Событие',
            'read_at' => 'Прочтено в',
            'created_at' => 'Создано в',
            'updated_at' => 'Обновлено в',
        ];
    }
}
