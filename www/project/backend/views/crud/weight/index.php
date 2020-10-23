<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DecoleWeightSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вес';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decole-weight-index">

    <p>
        <?= Html::a('Добавить вес', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'weight',
            [
                'label' => 'Создано',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyyy HH:mm:ss');
                }
            ],
            [
                'label' => 'Обновлено',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->updated_at, 'dd.MM.yyyy HH:mm:ss');
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
                                'confirm' => 'Удалить значение?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>


</div>
