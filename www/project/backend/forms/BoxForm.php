<?php

namespace backend\forms;

use backend\models\WarehouseBox;
use yii\base\Model;

class BoxForm extends Model
{
    public $rack_id;
    public $name;

    public static function tableName()
    {
        return 'warehouse_box';
    }

    public function rules()
    {
        return [
            [['rack_id'], 'integer'],
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
            'rack_id' => 'Стеллаж',
            'name' => 'Название',
        ];
    }

    public function uniqueValidate($attribute)
    {
        $model = WarehouseBox::findOne(['name' => $this->$attribute]);

        if ($model) {
            $this->addError($attribute, 'Не уникальное имя');
        }
    }
}
