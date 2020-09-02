<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSecureSystem */

$this->title = 'Create Module Secure System';
$this->params['breadcrumbs'][] = ['label' => 'Module Secure Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-secure-system-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
