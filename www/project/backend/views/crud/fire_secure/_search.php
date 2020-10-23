<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleFireSystemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-fire-system-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'topic') ?>

    <?= $form->field($model, 'normal_condition') ?>

    <?= $form->field($model, 'alarm_condition') ?>

    <?php // echo $form->field($model, 'message_info') ?>

    <?php // echo $form->field($model, 'message_ok') ?>

    <?php // echo $form->field($model, 'message_warn') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'notifying') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
