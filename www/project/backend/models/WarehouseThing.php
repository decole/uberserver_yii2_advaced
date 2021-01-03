<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "warehouse_thing".
 *
 * @property int $id
 * @property int|null $box_id
 * @property float|null $sum
 * @property string $name
 * @property string|null $description
 * @property int|null $photo
 * @property int $created_at
 * @property int $updated_at
 */
class WarehouseThing extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_thing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['box_id', 'created_at', 'updated_at'], 'integer'],
            [['sum'], 'number'],
            [['name', 'created_at', 'updated_at'], 'required'],
            [['name'], 'unique'],
            [['name', 'description', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'box_id' => 'Коробка',
            'sum' => 'Количество',
            'name' => 'Название',
            'description' => 'Описание',
            'photo' => 'Фото',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getBoxes()
    {
        return $this->hasOne(WarehouseBox::class, ['id' => 'box_id']);
    }
}
