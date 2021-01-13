<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WarehouseThing */

$this->title = 'Create Warehouse Thing';
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Things', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-thing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>