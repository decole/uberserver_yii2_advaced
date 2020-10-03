<?php

use frontend\components\relay\RelayWidget;
use frontend\components\sensor\SensorWidget;

/* @var $this yii\web\View */
$this->title = 'Все данные';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
<?php
/** @var array $sensors */
/** @var array $relays */
foreach ($sensors as $sensor) {
    try {
        echo SensorWidget::widget(['sensor' => $sensor]);
    } catch (Exception $e) {
    }
}
foreach ($relays as $relay) {
    try {
        echo RelayWidget::widget(['relay' => $relay]);
    } catch (Exception $e) {
    }
}
?>
        </div>
    </div>
</section>
