<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleLeakage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-leakage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_up')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_down')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message_ok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message_warn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->listBox($model->getListTypes(), ['size' => '1']) ?>

    <?= $form->field($model, 'location')->listBox($model->getListLocations(), ['size' => '1']) ?>

    <?= $form->field($model, 'notifying')->checkbox([
        'label' => 'Отправлять нотификации',
        'labelOptions' => ['style' => 'padding-left:20px; font-size: 20px;']
    ]) ?>

    <?= $form->field($model, 'active')->checkbox([
        'label' => 'Активный модуль',
        'labelOptions' => ['style' => 'padding-left:20px; font-size: 20px;']
    ]) ?>

    <div class="form-group">
        <?= Html::a('Назад', ['leakage-crud/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
