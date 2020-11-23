<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "weather".
 *
 * @property int $id
 * @property float|null $temperature_comfort
 * @property float|null $temperature_air
 * @property string|null $pressure
 * @property string|null $humidity
 * @property string|null $wind_speed
 * @property int|null $wind_scale
 * @property string|null $description
 * @property int $created_at
 */
class WeatherGismeteo extends ActiveRecord
{
    public static function tableName()
    {
        return 'weather_gismeteo';
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

    public function rules()
    {
        return [
            [['temperature_comfort', 'temperature_air'], 'number'],
            [['wind_scale', 'created_at'], 'integer'],
            [['pressure', 'humidity', 'wind_speed', 'description'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'temperature_comfort' => 'Temperature Comfort',
            'temperature_air' => 'Temperature Air',
            'pressure' => 'Pressure',
            'humidity' => 'Humidity',
            'wind_speed' => 'Wind Speed',
            'wind_scale' => 'Wind Scale',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }
}