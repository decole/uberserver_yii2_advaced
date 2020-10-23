<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleFireSystemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CRUD Пожарных датчиков';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-fire-system-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пожарный датчик', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'topic',
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
                        return  Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
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
