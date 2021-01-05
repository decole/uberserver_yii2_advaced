<?php

namespace backend\forms;

use backend\models\WarehouseThing;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ThingForm extends Model
{
    /**
     * @var mixed
     */
    public $box_id;

    /**
     * @var mixed
     */
    public $name;

    /**
     * @var mixed
     */
    public $sum;

    /**
     * @var mixed
     */
    public $description;

    /**
     * @var mixed
     */
    public $photo;

    /**
     * @var mixed
     */
    public $photo_path = null;

    /**
     * @return mixed[][]
     */
    public function rules(): array
    {
        return [
            [['name', 'sum'], 'required'],
            [['sum', 'box_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
//            [['name'], 'uniqueValidate'],
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
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

    public function uniqueValidate(string $attribute): void
    {
        $model = WarehouseThing::findOne(['name' => $this->$attribute]);

        if ($model) {
            $this->addError($attribute, 'Не уникальное имя');
        }
    }

    /**
     * @return bool|string
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');

            if (!empty($this->photo) && $this->photo->size !== 0) {
                $name = md5($this->photo->baseName) . '_' . time();

                $alias = Yii::getAlias('@backend');
                $path = $alias.'/web/uploads/' . $name . '.' . $this->photo->extension;
                $this->photo->saveAs($path);
                $this->photo_path = '/admin/uploads/' . $name . '.' . $this->photo->extension;

                return true;
            }
        }

        return false;
    }
}
