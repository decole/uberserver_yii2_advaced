<?php

use frontend\components\sensor\SensorWidget;
use hail812\adminlte3\assets\AdminLteAsset;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
$this->title = 'Теплица';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/Chart.min.js', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
$this->registerJsFile('@web/js/moment.min.js', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
$this->registerJsFile('@web/js/areachart.js', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
$this->registerJsFile('@web/js/sensor.js', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- AREA CHART -->
            <div class="d-none d-lg-block d-md-none d-xs-none col-lg-6 col-md-6 col-xs-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Теплица <b class="dateIs"><?=date('Y-m-d');?></b></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas class="sensorchart" data-topic="greenhouse/temperature" id="lineChart1" height="250"></canvas>
                        </div>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                            <input type="text" id="isDate" value="current" hidden>
                            <button type="button" class="btn btn-default" id="prev-date" ><</button>
                            <button type="button" class="btn btn-default" id="next-date" >></button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <?php
                /** @var array $sensors */
                foreach ($sensors as $sensor) {
                    try {
                        echo SensorWidget::widget(['sensor' => $sensor]);
                    } catch (Exception $e) {
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>