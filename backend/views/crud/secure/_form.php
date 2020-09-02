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

    <?= $form->field($model, 'trigger')->textInput() ?>

    <?= $form->field($model, 'current_command')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message_ok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message_warn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'location')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'notifying')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
