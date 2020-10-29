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

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Событие</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>2020-10-04 16:15:11</td>
                                    <td>home/security/margulis/1 - отмена взведения</td>
                                </tr>
                                <tr>
                                    <td>2020-10-04 16:15:09</td>
                                    <td>home/security/margulis/2 - отмена взведения</td>
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