<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleFireSystemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Module Fire Systems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-fire-system-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Module Fire System', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'topic',
            'normal_condition',
            'alarm_condition',
            //'message_info',
            //'message_ok',
            //'message_warn',
            //'type',
            //'location',
            //'created_at',
            //'updated_at',
            //'notifying',
            //'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
