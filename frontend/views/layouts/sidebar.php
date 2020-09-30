<?php

use hail812\adminlte3\widgets\Menu;
use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">UberServer</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?=Yii::$app->user->identity->username;?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
//                    ['label' => 'Настройки системы', 'header' => true],
//                    ['label' => 'Сенсоры', 'url' => ['module-sensor-crud/index'], 'iconStyle' => 'far'],
//                    ['label' => 'Сенсоры Протечки', 'url' => ['leakage-crud/index'], 'iconStyle' => 'far'],
//                    ['label' => 'Реле', 'url' => ['module-relay-crud/index'], 'iconStyle' => 'far'],
//                    ['label' => 'Типы устройств', 'url' => ['module-type-crud/index'], 'iconStyle' => 'far'],
//                    ['label' => 'Место устройств', 'url' => ['location-crud/index'], 'iconStyle' => 'far'],
//                    ['label' => 'Охранные датчики', 'url' => ['secure-system-crud/index'],  'iconStyle' => 'far'],
//                    ['label' => 'Пожарные датчики', 'url' => ['fire-system-crud/index'], 'iconStyle' => 'far'],
//                    ['label' => 'Планировщик', 'url' => ['schedule/index'], 'iconStyle' => 'far'],
//                    ['label' => 'Вес', 'url' => ['decole-weight-crud/index'], 'iconStyle' => 'far'],

                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>