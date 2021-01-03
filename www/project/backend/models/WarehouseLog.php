<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "warehouse_log".
 *
 * @property int $id
 * @property int $thing_id
 * @property string $thing_name
 * @property int $move_from_box
 * @property int $move_to_box
 * @property int $move_from_rack
 * @property int $move_to_rack
 * @property int $created_at
 */
class WarehouseLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thing_id', 'thing_name', 'move_from_box', 'move_to_box', 'move_from_rack', 'move_to_rack', 'created_at'], 'required'],
            [['thing_id', 'move_from_box', 'move_to_box', 'move_from_rack', 'move_to_rack', 'created_at'], 'integer'],
            [['thing_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thing_id' => 'Thing ID',
            'thing_name' => 'Thing Name',
            'move_from_box' => 'Move From Box',
            'move_to_box' => 'Move To Box',
            'move_from_rack' => 'Move From Rack',
            'move_to_rack' => 'Move To Rack',
            'created_at' => 'Created At',
        ];
    }
}
