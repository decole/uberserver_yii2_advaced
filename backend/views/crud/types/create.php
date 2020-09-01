<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleType */

$this->title = 'Создание Типа Модуля';
$this->params['breadcrumbs'][] = ['label' => 'Типы Модулей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
