<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "weather".
 *
 * @property int $id
 * @property float|null $temperature
 * @property string|null $spec
 * @property int $created_at
 * @property int $updated_at
 */
class Weather extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'weather';
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
            [['temperature'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['spec'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'temperature' => 'Temperature',
            'spec' => 'Spec',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}