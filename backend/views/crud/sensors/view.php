<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSensor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Module Sensors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="module-sensor-view">

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
            'to_condition',
            'from_condition',
            'message_info',
            'message_ok',
            'message_warn',
            'type',
            'location',
            [
                'label' => 'Создано',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyyy H:m:s');
                }
            ],
            [
                'label' => 'Обновлено',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->updated_at, 'dd.MM.yyyy H:m:s');
                }
            ],
        ],
    ]) ?>

</div>
