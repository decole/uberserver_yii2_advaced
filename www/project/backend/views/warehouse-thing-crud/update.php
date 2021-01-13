<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WarehouseThing */

$this->title = 'Update Warehouse Thing: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Things', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warehouse-thing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>