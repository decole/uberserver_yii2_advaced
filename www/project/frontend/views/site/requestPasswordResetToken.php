<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\bootstrap\ActiveForm;

$this->title = 'Забыл пароль';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Забыл свой пароль? Запроси новый пароль на электронную почту.
        <span class=""><?= Yii::$app->session->getFlash('success');?></span>
        </p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <div class="input-group mb-3">
                <input type="email" id="passwordresetrequestform-email" class="form-control" name="PasswordResetRequestForm[email]" autofocus="" placeholder="Email">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Запросить новый пароль</button>
                </div>
                <!-- /.col -->
            </div>
            <?php ActiveForm::end(); ?>

        <p class="mt-3 mb-1">
            <a href="/site/login">Login</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>