<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSecureSystem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-secure-system-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'normal_condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alarm_condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trigger')->checkbox([
        'label' => 'Взведено',
        'labelOptions' => ['style' => 'padding-left:20px; font-size: 20px;']
    ]) ?>

    <?= $form->field($model, 'current_command')->textInput(['maxlength' => true]) ?>

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
        <?= Html::a('Назад', ['secure-system-crud/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
