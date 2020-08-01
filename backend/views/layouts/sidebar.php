<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Настройки', 'url' => ['site/faker'], 'icon' => 'cogs'],
                    ['label' => 'Автополив', 'url' => ['site/faker'], 'icon' => 'tint'],
                    ['label' => 'Пожарная система', 'url' => ['site/faker'], 'icon' => 'fire'],
                    ['label' => 'Охранная система', 'url' => ['site/faker'], 'icon' => 'user-lock'],
                    ['label' => 'Все даные', 'url' => ['site/faker'], 'icon' => 'folder-open'],
                    ['label' => 'Пристройка', 'url' => ['site/faker'], 'icon' => 'border-style'],
                    ['label' => 'Теплица', 'url' => ['site/faker'], 'icon' => 'folder-open'],

                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],

                    ['label' => 'CRUD', 'header' => true],
                    [
                        'label' => 'Параметры',
                        'items' => [
                            ['label' => 'Сенсоры', 'iconStyle' => 'far'],
                            ['label' => 'Реле', 'iconStyle' => 'far'],
                            ['label' => 'Типы устройств', 'iconStyle' => 'far'],
                            ['label' => 'Место устройств', 'iconStyle' => 'far'],
                            ['label' => 'Охранные датчики', 'iconStyle' => 'far'],
                            ['label' => 'Пожарные датчики', 'iconStyle' => 'far'],
                            ['label' => 'Планировщик', 'iconStyle' => 'far'],
                            ['label' => 'Вес', 'iconStyle' => 'far'],
                            ['label' => 'Дефект заданий', 'iconStyle' => 'far'],
                        ]
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>