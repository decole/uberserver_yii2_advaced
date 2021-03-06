<?php

use frontend\components\notify\NotifyWidget;
use yii\helpers\Html;

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
<!--            <a href="--><?//= Url::home()?><!--" class="nav-link">Home</a>-->
            <a href="/" class="nav-link">На главную</a>
        </li>
<!--        <li class="nav-item d-none d-sm-inline-block">-->
<!--            <a href="#" class="nav-link">Contact</a>-->
<!--        </li>-->
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Опции</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><?= Html::a('Test-icons', ['site/test-icons'], ['data-method' => 'post', 'class' => 'dropdown-item']) ?></li>
                <li><?= Html::a('Sign out', ['site/logout'], ['data-method' => 'post', 'class' => 'dropdown-item']) ?></li>

                <li class="dropdown-divider"></li>

                <!-- Level two dropdown-->
                <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Админ</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li>
                            <a tabindex="-1" href="/admin/" class="dropdown-item">Админ панель</a>
                        </li>

                        <!-- Level three dropdown -->
                        <!--<li class="dropdown-submenu"> -->
<!--                            <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>-->
<!--                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">-->
<!--                                <li><a href="#" class="dropdown-item">3rd level</a></li>-->
<!--                                <li><a href="#" class="dropdown-item">3rd level</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
                        <!-- End Level three -->

                        <li><a href="#" class="dropdown-item">level 2</a></li>
                        <li><a href="#" class="dropdown-item">level 2</a></li>
                    </ul>
                </li>
                <!-- End Level two -->
            </ul>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <?=NotifyWidget::widget(['params' => ['messages', 'requests', 'reports']])?>
        </li>

        <li class="nav-item">
            <?=Html::a('<i class="fas fa-sign-out-alt"></i>', ['site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="https://www.gravatar.com/avatar/<?=md5(Yii::$app->user->identity->email)?>.jpg" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?=Yii::$app->user->identity->username?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="https://www.gravatar.com/avatar/<?=md5(Yii::$app->user->identity->email)?>.jpg" class="img-circle elevation-2" alt="User Image">

                    <p>
                        <?=Yii::$app->user->identity->username;?> - Web Developer
                        <small>Member since Nov. 2012</small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    <?=Html::a('Sign out', ['site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat float-right'])?>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                    class="fas fa-th-large"></i></a>
        </li>
    </ul>
</nav>