<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleLeakage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Module Leakages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="module-leakage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'topic',
            'check_up',
            'check_down',
            'message_info',
            'message_ok',
            'message_warn',
            'type',
            'location',
            'notifying',
            'active',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
