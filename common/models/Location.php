<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $location
 */
class Location extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location'], 'required'],
            [['location'], 'string', 'max' => 255],
            [['location'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Location',
        ];
    }
}
