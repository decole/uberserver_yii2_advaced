<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DecoleWeight */

$this->title = 'Изменение веса: ' . $model->weight;
$this->params['breadcrumbs'][] = ['label' => 'Вес', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="decole-weight-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
