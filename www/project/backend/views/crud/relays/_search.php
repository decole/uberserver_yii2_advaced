<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleRelaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-relay-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'topic') ?>

    <?= $form->field($model, 'check_topic') ?>

    <?= $form->field($model, 'command_on') ?>

    <?php // echo $form->field($model, 'command_off') ?>

    <?php // echo $form->field($model, 'check_command_on') ?>

    <?php // echo $form->field($model, 'check_command_off') ?>

    <?php // echo $form->field($model, 'last_command') ?>

    <?php // echo $form->field($model, 'message_info') ?>

    <?php // echo $form->field($model, 'message_ok') ?>

    <?php // echo $form->field($model, 'message_warn') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
