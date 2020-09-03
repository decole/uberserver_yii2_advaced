<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "module_sensor".
 *
 * @property int $id
 * @property string $name
 * @property string $topic
 * @property string|null $message_info
 * @property string|null $message_ok
 * @property string|null $message_warn
 * @property int|null $to_condition
 * @property int|null $from_condition
 * @property int|null $type
 * @property int|null $location
 * @property int $created_at
 * @property int $updated_at
 */
class Model extends ActiveRecord
{
    public function getListLocations()
    {
        return ArrayHelper::map(Location::find()->asArray()->all(), 'id', 'location');
    }

    public function getListTypes()
    {
        return ArrayHelper::map(ModuleType::find()->asArray()->all(), 'id', 'name');
    }
}
