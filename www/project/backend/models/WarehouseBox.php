<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "warehouse_box".
 *
 * @property int $id
 * @property int|null $rack_id
 * @property string $name
 * @property int $created_at
 */
class WarehouseBox extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_box';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rack_id', 'created_at'], 'integer'],
            [['name', 'created_at'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rack_id' => 'Rack ID',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }
}
