<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "warehouse_rack".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 */
class WarehouseRack extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_rack';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at'], 'required'],
            [['created_at'], 'integer'],
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
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }
}
