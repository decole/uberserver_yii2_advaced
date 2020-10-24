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
                <img src="https://www.gravatar.com/avatar/<?=md5(Yii::$app->user->identity->email)?>.jpg" class="img-circle elevation-2" alt="User Image">
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
                    ['label' => 'Стандартное', 'header' => true],

                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],

                    ['label' => 'Портированное', 'header' => true],

                    ['label' => 'Настройки', 'url' => ['#'], 'iconStyle' => 'fas fa-cogs'],
                    ['label' => 'Автополив', 'url' => ['#'], 'iconStyle' => 'fas fa-tint'],
                    ['label' => 'Пожарная система', 'url' => ['/site/fire-secure'], 'iconStyle' => 'fab fa-free-code-camp'],
                    ['label' => 'Охранная система', 'url' => ['/site/secure'], 'iconStyle' => 'fas fa-user-lock'],
                    ['label' => 'Все данные', 'url' => ['/site/all-data'], 'iconStyle' => 'fas fa-folder-open'],
                    ['label' => 'Пристройка', 'url' => ['/site/margulis'], 'iconStyle' => 'fas fa-folder-open'],
                    ['label' => 'Теплица', 'url' => ['#'], 'iconStyle' => 'fas fa-folder-open'],

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