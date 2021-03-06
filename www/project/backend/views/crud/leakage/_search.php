<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleLeakageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-leakage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'topic') ?>

    <?= $form->field($model, 'check_up') ?>

    <?= $form->field($model, 'check_down') ?>

    <?php // echo $form->field($model, 'message_info') ?>

    <?php // echo $form->field($model, 'message_ok') ?>

    <?php // echo $form->field($model, 'message_warn') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'notifying') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
