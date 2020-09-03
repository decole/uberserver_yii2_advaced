<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleRelay */

$this->title = 'Создание реле';
$this->params['breadcrumbs'][] = ['label' => 'Модули реле', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-relay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
