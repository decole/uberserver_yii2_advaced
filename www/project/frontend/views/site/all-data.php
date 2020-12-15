<?php

use frontend\components\relay\RelayWidget;
use frontend\components\sensor\SensorWidget;
use hail812\adminlte3\assets\AdminLteAsset;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
$this->title = 'Все данные';
$this->params['breadcrumbs'][] = $this->title;

// добавление логики работы UI для сенсоров
$this->registerJsFile('@web/js/sensor.js', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
$this->registerJsFile('@web/js/relay.js', ['depends' => [JqueryAsset::class, AdminLteAsset::class]]);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-12">
<?php
/** @var array $sensors */
/** @var array $relays */
foreach ($sensors as $sensor) {
    try {
        echo SensorWidget::widget(['sensor' => $sensor]);
    } catch (Exception $e) {
    }
}?>
            </div>
            <div class="col-lg-6 col-md-12 col-xs-12">
<?php
foreach ($relays as $relay) {
    try {
        echo RelayWidget::widget(['relay' => $relay]);
    } catch (Exception $e) {
    }
}
?>
            </div>
        </div>
    </div>
</section>
