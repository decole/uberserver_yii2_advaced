<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */

$this->title = 'Изменение Задания: ' . $model->command;
$this->params['breadcrumbs'][] = ['label' => 'Задание', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->command, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="schedule-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
