<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleSecureSystemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Module Secure Systems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-secure-system-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Module Secure System', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'trigger',
            //'current_command',
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
