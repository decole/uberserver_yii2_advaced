<?php

use yii\web\JqueryAsset;

/* @var $this yii\web\View */
$this->title = 'Система безопасности';
$this->params['breadcrumbs'][] = $this->title;

// добавление логики работы UI для сенсоров
$this->registerJsFile(
    '@web/js/secure.js?0.2',
    ['depends' => [JqueryAsset::class]]
);
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
                                <h3 class="card-title">Пульт управления охранной системой</h3>

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
                                        <th class="text-center">Команда</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>[ ОШС-2 ] - холодная прихожка</td>
                                        <td class="text-center secure-sensor-state-text">Не взведен</td>
                                        <td class="text-center py-0 align-middle">
                                            <div class="btn-group btn-group-sm secure-sensor-control" data-secstate-topic="home/security/margulis/2">
                                                <a class="btn secure-trigger-on btn-outline-danger"><i class="fas fa-eye"></i></a>
                                                <a class="btn secure-trigger-off btn-outline-success active"><i class="fas fa-eye-slash"></i></a>
                                                <a class="btn secure-state-info btn-outline-info active"><i class="fas fa-male"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>[ ОШС-1 ] - прихожка дома</td>
                                        <td class="text-center secure-sensor-state-text">Не взведен</td>
                                        <td class="text-center py-0 align-middle">
                                            <div class="btn-group btn-group-sm secure-sensor-control" data-secstate-topic="home/security/margulis/1">
                                                <a class="btn secure-trigger-on btn-outline-danger"><i class="fas fa-eye"></i></a>
                                                <a class="btn secure-trigger-off btn-outline-success active"><i class="fas fa-eye-slash"></i></a>
                                                <a class="btn secure-state-info btn-outline-info active"><i class="fas fa-male"></i></a>
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
                            <div class="card-body">
                                <?php
                                echo yii\grid\GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'showHeader' => false,
                                    'layout'=>'{items}{pager}',
//                                    'layout'=>'{sorter}\n{pager}\n{summary}\n{items}',
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        'topic',
                                        'payload',
                                        [
                                            'attribute' => 'created_at',
                                            'format' =>  ['date', 'dd.MM.YYYY HH:mm:ss '],
                                            'options' => ['width' => '200']
                                        ],
                                    ],
                                    'tableOptions' => [
                                        'class' => 'table table-bordered'
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
            </section>
        </div>
    </div>
</section>