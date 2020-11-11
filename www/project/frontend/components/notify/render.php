<?php

use yii\helpers\Html;

/** @var int $model */
/** @var int $requests */
/** @var int $reports */
?>
<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <?php if ($count > 0) {?>
    <span class="badge badge-warning navbar-badge"><?=$count?></span>
    <?php } ?>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header"><?=$count?> Notifications</span>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> <?=$messages?> new messages
        <span class="float-right text-muted text-sm">3 mins</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-users mr-2"></i> <?=$requests?> friend requests
        <span class="float-right text-muted text-sm">12 hours</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-file mr-2"></i> <?=$reports?> new reports
        <span class="float-right text-muted text-sm">2 days</span>
    </a>
    <div class="dropdown-divider"></div>
    <?php
    if ($count > 0) {
        echo Html::a('See All Notifications', ['notify'], ['data-method' => 'post', 'class' => 'dropdown-item dropdown-footer']);
    }
    ?>
</div>
