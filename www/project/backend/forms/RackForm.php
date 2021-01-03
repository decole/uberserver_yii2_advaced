<?php

namespace backend\forms;

use backend\models\WarehouseRack;
use yii\base\Model;

class RackForm extends Model
{
    public $name;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'uniqueValidate'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
        ];
    }

    public function uniqueValidate($attribute)
    {
        $model = WarehouseRack::findOne(['name' => $this->$attribute]);

        if ($model) {
            $this->addError($attribute, 'Не уникальное имя');
        }
    }
}
