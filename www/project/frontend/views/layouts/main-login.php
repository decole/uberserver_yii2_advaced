<?php

use hail812\adminlte3\assets\AdminLteAsset;
use hail812\adminlte3\assets\PluginAsset;
use yii\helpers\Html;
use yii\web\View;

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

/* @var $this View */
/* @var $content string */

AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);

$this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="/favicon.png" sizes="32x32" />
    <link rel="icon" href="/favicon.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="/favicon.png" />
    <meta name="msapplication-TileImage" content="/favicon.png" /
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php  $this->beginBody() ?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?=Yii::$app->homeUrl?>"><b>Uber</b>server</a>
    </div>
    <!-- /.login-logo -->

    <?= $content ?>
</div>
<!-- /.login-box -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>