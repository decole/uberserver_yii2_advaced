<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleSecureSystemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CRUD Охранных модулей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-secure-system-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать охранный модуль', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'topic',
            [
                'label' => 'Взведен',
                'value' => function ($model) {
                    return ($model->trigger) ? 'Да' : 'Нет';
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
