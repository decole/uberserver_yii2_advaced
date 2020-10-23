<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */

$this->title = 'Создание задачи';
$this->params['breadcrumbs'][] = ['label' => 'Новая Задача', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
