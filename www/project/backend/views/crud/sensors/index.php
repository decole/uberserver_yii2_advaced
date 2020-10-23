<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleSensorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CRUD Модуль - Сенсор';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-sensor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать модуль', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return  Html::a($model->name, $url);
                    },
                ]
            ],
            'topic',
            'to_condition',
            'from_condition',
            [
                'label' => 'Тип датчика',
                'value' => function ($model) {
                    return $model->types->name;
                }
            ],
            [
                'label' => 'Находится',
                'value' => function ($model) {
                    return $model->locations->location;
                }
            ],
            [
                'label' => 'Сообщать о событиях',
                'value' => function ($model) {
                    return ($model->notifying) ? 'Да' : 'Нет';
                }
            ],
            [
                'label' => 'Активно',
                'value' => function ($model) {
                    return ($model->active) ? 'Да' : 'Нет';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return  Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return  Html::a('Удалить', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Удалить модуль?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

</div>
