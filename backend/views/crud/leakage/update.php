<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleLeakage */

$this->title = 'Update Module Leakage: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Module Leakages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-leakage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
