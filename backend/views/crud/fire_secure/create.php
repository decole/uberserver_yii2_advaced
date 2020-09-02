<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleFireSystem */

$this->title = 'Create Module Fire System';
$this->params['breadcrumbs'][] = ['label' => 'Module Fire Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-fire-system-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
