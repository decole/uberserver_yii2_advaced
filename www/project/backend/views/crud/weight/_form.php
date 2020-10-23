<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DecoleWeight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="decole-weight-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
