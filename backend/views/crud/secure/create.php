<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSecureSystem */

$this->title = 'Создание Охранного модуля';
$this->params['breadcrumbs'][] = ['label' => 'CRUD Охранных модулей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-secure-system-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
