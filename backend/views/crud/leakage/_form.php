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

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'location')->textInput() ?>

    <?= $form->field($model, 'notifying')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
