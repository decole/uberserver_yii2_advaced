<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DecoleWeight */

$this->title = 'Добавление значения';
$this->params['breadcrumbs'][] = ['label' => 'Вес', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decole-weight-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
