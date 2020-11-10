<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Список извещений';
$this->params['breadcrumbs'][] = $this->title;

?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <?php
                /** @var boolean $refreshed */
                if ($refreshed) {
                ?>
                <div class="alert alert-success">
                    Данные обновлены
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Список событий
                        </h3>

                        <div class="card-tools">--
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        echo yii\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'type',
                                'data',
                                [
                                    'attribute' => 'created_at',
                                    'format' =>  ['date', 'dd.MM.YYYY HH:mm:ss '],
                                    'options' => ['width' => '200']
                                ],
//                        [
//                            'attribute'=>'created_at',
//                            'content'=>function($data){
//                                return Yii::$app->formatter->asDate($data->created_at, 'dd.MM.yyyy HH:mm:ss');
//                            }
//                        ],
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
                    <div class="card-footer clearfix">
                        <?= Html::a('See All Notifications',
                            ['notify'],
                            [
                                'data-method' => 'post',
                                'data' => [
                                    'method' => 'post',
                                    'params' => [
                                        'clear' => 'all',
                                    ],
                                ],
                                'class' => 'dropdown-item dropdown-footer',
                            ]) ?>

                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
    </div>
</section>