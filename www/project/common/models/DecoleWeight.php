<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "decole_weight".
 *
 * @property int $id
 * @property float $weight
 * @property int $created_at
 * @property int $updated_at
 */
class DecoleWeight extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'decole_weight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weight'], 'required'],
            ['weight', 'floatValidate'],
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
                'updatedAtAttribute' => 'updated_at',
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
            'weight' => 'Вес',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function floatValidate(string $attribute): void
    {
        $this->$attribute = str_replace(',', '.', $this->$attribute);

        if (filter_var($this->$attribute, FILTER_VALIDATE_FLOAT) === false) {
            $this->addError($attribute, 'Нужно указать правильное значение '.$this->getAttributeLabel($attribute));
        }

        $this->$attribute = round($this->$attribute, 2);
    }
}