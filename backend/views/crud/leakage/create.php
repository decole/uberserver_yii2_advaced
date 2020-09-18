<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleLeakage */

$this->title = 'Create Module Leakage';
$this->params['breadcrumbs'][] = ['label' => 'Module Leakages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-leakage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
