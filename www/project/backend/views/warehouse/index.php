<?php

use backend\models\WarehouseBox;
use backend\models\WarehouseRack;
use backend\models\WarehouseThing;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Склад электроники';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <h2>Создание Вещи</h2>
<?php
$form = ActiveForm::begin([
    'id' => 'thing-form',
    'options' => [
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data',
    ],
]);

$items = WarehouseBox::find()
    ->select(['name'])
    ->indexBy('id')
    ->column();
?>
<?php echo $form->field($model, 'box_id')->radioList($items, ['prompt' => 'Select Box'])?>
<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'sum') ?>
<?php echo $form->field($model, 'description') ?>
<?php echo $form->field($model, 'photo')->fileInput() ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?php echo Html::submitButton('Сохранить вещь', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<?php

$dataProvider = new ActiveDataProvider([
    'query' => WarehouseThing::find()->with('boxes'),
    'pagination' => [
        'pageSize' => 20,
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'sum',
        'description',
        'boxes.name',
        [
            'attribute' => 'photo',
            'format' => 'html',
            'label' => 'photo',
            'value' => fn ($data) => Html::img($data['photo'],
                ['width' => '80px', 'height' => '80px']
            ),
        ],
        'created_at:datetime',
    ],
])
?>
        </div>
        <div class="col-lg-6">
            <h2>Создание коробки</h2>
<?php
$formBox = ActiveForm::begin([
    'id' => 'box-form',
    'options' => [
        'class' => 'form-horizontal',
    ],
]);

$itemsRack = WarehouseRack::find()
    ->select(['name'])
    ->indexBy('id')
    ->column();
?>
<?php echo $formBox->field($modelBox, 'rack_id')->radioList($itemsRack, ['prompt' => 'Select Rack'])?>
<?php echo $formBox->field($modelBox, 'name') ?>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?php echo Html::submitButton('Сохранить коробку', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
            <h2>Создание стеллажа</h2>
            <?php
            $formRack = ActiveForm::begin([
                'id' => 'rack-form',
                'options' => [
                'class' => 'form-horizontal',
                ],
            ]);
            ?>
<?php echo $formRack->field($modelRack, 'name') ?>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?php echo Html::submitButton('Сохранить стеллаж', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
        </div>
    </div>
</div>