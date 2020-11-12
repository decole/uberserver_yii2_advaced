<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var array $data */
?>
<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <?php if ($data['count'] > 0) {?>
    <span class="badge badge-warning navbar-badge"><?=$data['count']?></span>
    <?php } ?>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header"><?=$data['count']?> Notifications</span>
    <?php if ($data['messages'] > 0) {?>
    <div class="dropdown-divider"></div>
    <a href="<?= Url::toRoute('notify')?>" class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> <?=$data['messages']?> new messages
        <span class="float-right text-muted text-sm">3 mins</span>
    </a>
    <?php } if ($data['requests'] > 0) {?>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-users mr-2"></i> <?=$data['requests']?> friend requests
        <span class="float-right text-muted text-sm">12 hours</span>
    </a>
    <?php } if ($data['reports'] > 0) {?>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-file mr-2"></i> <?=$data['reports']?> new reports
        <span class="float-right text-muted text-sm">2 days</span>
    </a>
    <?php } ?>
    <div class="dropdown-divider"></div>
    <?php
    if ($data['count'] > 0) {
        echo Html::a('See All Notifications', ['notify'], ['data-method' => 'post', 'class' => 'dropdown-item dropdown-footer']);
    }
    ?>
</div>
