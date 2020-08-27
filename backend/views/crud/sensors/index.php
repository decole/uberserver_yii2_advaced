<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleSensorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Module Sensors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-sensor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Module Sensor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
        ],
    ]); ?>

<!--<pre>
<?php
//    var_dump($dataProvider);
//    ?>
</pre>-->
</div>
