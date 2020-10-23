<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Location */

$this->title = 'Редактирование: ' . $model->location;
$this->params['breadcrumbs'][] = ['label' => 'Локации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->location, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
