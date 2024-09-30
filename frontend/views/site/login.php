<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <div class="row" style="margin-left: 8px; width:95%; padding-top: 10px;">
            <div class="col-md-4" style="text-align: center; padding: 0 !important;">
                <img src="<?= Url::to('@web/images/logo.png'); ?>" style="width: 110px;">
            </div>
            <div class="col-md-8 heading-kanan">
                <p class="judul">E-PBB KOTA KENDARI</p>
                <p class="sub-judul">BADAN PENDAPATAN DAERAH</p>
                <p class="sub-judul">KOTA KENDARI</p>
            </div>
        </div>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?php
        if (Yii::$app->session->get('error')) {
        ?>
            <div class="alert alert-danger error-message">
                <?= Yii::$app->session->get('error') ?>
            </div>
        <?php
        }

        if (Yii::$app->session->get('success')) {
        ?>
            <div class="alert alert-success success-message">
                <?= Yii::$app->session->get('success') ?>
            </div>
        <?php
        }
        ?>
        <p class="login-box-msg">Masuk untuk mulai menggunakan aplikasi</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput([
                'placeholder' => $model->getAttributeLabel('username'),
                'style' => 'border-radius: 4px;' // Ganti 10px sesuai dengan radius yang Anda inginkan
            ])?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput([
                'placeholder' => $model->getAttributeLabel('password'),
                'style' => 'border-radius: 4px;' // Ganti 10px sesuai dengan radius yang Anda inginkan
            ]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Masuk', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button', 'style' => 'border-radius:3px;']) ?>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a href="<?= Url::to('@web/site/request-password-reset') ?>" class="text-center">Lupa Password ?</a>
            </div>
            <div class="col-xs-12">
                <a href="<?= Url::to('@web/site/resend-verification-email') ?>" class="text-center">Kirim ulang email verifikasi</a>
            </div>
        </div>


        <?php ActiveForm::end(); ?>

        <p></p>
        <!-- <a href="#">I forgot my password</a><br> -->
        <div class="row g-0">
            <div class="col-md-6">
                <a href="<?= Url::to('@web/cek-piutang/index') ?>" class="text-center"><button class="btn btn-block btn-flat" style="background-color:orange;color:#fff;border:none;border-radius:3px;">Cek Piutang</button></a>
            </div>
            <div class="col-md-6 tombol-kanan">
                <a href="<?= Url::to('@web/site/signup') ?>" class="text-center"><button class="btn btn-primary btn-block btn-flat btn-daftar" style="border:none;border-radius:3px;">Daftar</button></a>
            </div>
        </div>
    </div>
    <div style="text-align: center;">
        <h5>Copyright © 2024</h5>
        <h5>Badan Pendapatan Daerah Kota Kendari</h5>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->