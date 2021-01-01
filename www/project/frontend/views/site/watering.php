<?php

use frontend\components\relay\RelayWidget;
use hail812\adminlte3\assets\AdminLteAsset;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
$this->title = 'Пристройка';
$this->params['breadcrumbs'][] = $this->title;

// добавление логики работы UI для сенсоров
$this->registerJsFile('@web/js/sensor.js', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
$this->registerJsFile('@web/js/relay.js', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-md-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Пульт управления автополивом</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Клапан</th>
                                <th class="text-center">Топик</th>
                                <th class="text-center" style="width: 120px;">Состояние</th>
                                <th class="text-center">Следующее включение</th>
                                <th class="text-center">Следующее выключение</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $_i = 0;
                            /** @var mixed[] $watering */
                            /** @var mixed[] $scenario */
                            /** @var mixed[][] $sensor */
                            foreach ($watering as $topic) {
                            ?>
                            <tr>
                                <td>[ <?=$_i++?> ] - <?=$topic['name']?></td>
                                <td class="watering-state"><?=$topic['topic']?></td>
                                <td class="text-right py-0 align-middle">
                                    <?=RelayWidget::widget(['relay' => $sensor[$topic['topic']], 'template' => 'only-buttons']); ?>
                                </td>
                                <td class="text-right py-0 align-middle"><?=$scenario[$topic['topic']]['start'] ?>
<!--                                    <a href="{{ route('scheduler.edit',$swift->watering_start['start_time_job_id']) }}" class="btn btn-default"><i class="fas fa-cogs"></i></a></td>-->
                                <td class="text-right py-0 align-middle"><?=$scenario[$topic['topic']]['end'] ?>
<!--                                    <a href="{{ route('scheduler.edit',$swift->watering_start['end_time_job_id']) }}" class="btn btn-default"><i class="fas fa-cogs"></i></a></td>-->
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- /.right col -->
            <div class="col-xl-4 col-md-4">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Произошедшие события</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <?php
                    echo yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'showHeader' => false,
                        'layout' => '{items}{pager}',
                        'columns' => [
                            'name',
                            'topic',
                            'payload',
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'dd.MM.YYYY HH:mm:ss '],
                                'options' => ['width' => '200'],
                            ],
                        ],
                        'tableOptions' => [
                            'class' => 'table table-bordered',
                        ],
                        'pager' => [
                            'class' => 'frontend\components\widgets\LinkPager',
                        ],
                    ]);
                    ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.left col -->
        </div>
    </div>
</section>