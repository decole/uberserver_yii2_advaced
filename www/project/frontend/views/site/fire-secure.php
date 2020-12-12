<?php

use hail812\adminlte3\assets\AdminLteAsset;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
$this->title = 'Система пожарной безопасности';
$this->params['breadcrumbs'][] = $this->title;

// добавление логики работы UI для сенсоров
$this->registerJsFile('@web/js/fire_secure.js?0.1', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- Left col -->
            <section class="col-lg-12 col-xs-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Пульт пожарной системы</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Датчик</th>
                                        <th class="text-center">Состояние</th>
                                        <th class="text-center" style="width: 30px">Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>[ ППК-5 ] - зал и пристройка</td>
                                        <td class="text-center">Работает</td>
                                        <td class="text-center py-0 align-middle">
                                            <div class="btn-group btn-group-sm fire-sensor-control" data-secstate-topic="home/firesensor/fire_state" data-secstate-id="5" data-condition-normal="0" data-condition-alarm="1">
                                                <a class="btn btn-outline-success active"><i class="fas fa-lightbulb"></i></a>
                                                <a style="display: none;" class="btn btn-outline-danger"><i class="fas fa-fire"></i></a>
                                            </div>
                                        </td>
                                    </tr>










                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.right col -->
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Произошедшие события</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Событие</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>2020-09-10 21:53:11</td>
                                    <td>home/firesensor/fire_state - зафиксирован статус - пожар</td>
                                </tr>
                                <tr>
                                    <td>2020-09-10 21:53:06</td>
                                    <td>home/firesensor/fire_state - зафиксирован статус - пожар</td>
                                </tr>
                                <tr>
                                    <td>2020-09-10 21:53:01</td>
                                    <td>home/firesensor/fire_state - зафиксирован статус - пожар</td>
                                </tr>
                                <tr>
                                    <td>2020-09-10 21:52:56</td>
                                    <td>home/firesensor/fire_state - зафиксирован статус - пожар</td>
                                </tr>
                                <tr>
                                    <td>2020-09-10 21:52:51</td>
                                    <td>home/firesensor/fire_state - зафиксирован статус - пожар</td>
                                </tr>
                                <tr>
                                    <td>2020-09-10 21:52:46</td>
                                    <td>home/firesensor/fire_state - зафиксирован статус - пожар</td>
                                </tr>
                                <tr>
                                    <td>2020-09-10 21:52:41</td>
                                    <td>home/firesensor/fire_state - зафиксирован статус - пожар</td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <nav>
                                    paginator
                                </nav>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.left col -->
                </div>
            </section>
        </div>
    </div>
</section>