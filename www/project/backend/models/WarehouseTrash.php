<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "warehouse_trash".
 *
 * @property int $id
 * @property string $entity_type
 * @property string $entity_name
 * @property string|null $description
 * @property float|null $sum
 * @property int|null $photo
 * @property int $created_at
 */
class WarehouseTrash extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_trash';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_type', 'entity_name', 'created_at'], 'required'],
            [['sum'], 'number'],
            [['photo', 'created_at'], 'integer'],
            [['entity_type', 'entity_name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_type' => 'Entity Type',
            'entity_name' => 'Entity Name',
            'description' => 'Description',
            'sum' => 'Sum',
            'photo' => 'Photo',
            'created_at' => 'Created At',
        ];
    }
}
