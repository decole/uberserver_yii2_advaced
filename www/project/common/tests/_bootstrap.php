<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');
defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', __DIR__.'/../../');

require_once __DIR__ .  '/../../vendor/autoload.php';
require_once __DIR__ .  '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../config/bootstrap.php';

$loader = require(__DIR__.'/../../vendor/autoload.php');
$loader->add('AspectMock', __DIR__ . '/../src');
$loader->add('demo', __DIR__ . '/_data');
$loader->register();

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'cacheDir' => __DIR__.'/_data/cache',
    'includePaths' => [__DIR__.'/_data/demo'],
    'interceptFunctions' => true
]);