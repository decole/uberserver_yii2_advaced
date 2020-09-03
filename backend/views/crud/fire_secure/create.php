<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleFireSystem */

$this->title = 'Создание Пожарный модуля';
$this->params['breadcrumbs'][] = ['label' => 'CRUD Пожарных датчиков', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-fire-system-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
