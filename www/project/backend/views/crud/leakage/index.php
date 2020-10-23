<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleLeakageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CRUD Модуль протечки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-leakage-index">

    <p>
        <?= Html::a('Создать модуль протечки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'topic',
            'check_up',
            'check_down',
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
