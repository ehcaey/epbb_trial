<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Signup';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box signup" style="width: 500px;">
    <div class="login-logo">
        <!-- <a href="/"><b>E-PBB<br>Kota Kendari</b></a> -->
        <h3 class="text-center">DAFTAR</h3>
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
        <!-- <p class="login-box-msg">Daftar</p> -->
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => false, 'style' => 'border-radius: 4px;']) ?>

            <?= $form->field($model, 'email')->textInput(['style' => 'border-radius: 4px;']) ?>

            <?= $form->field($model, 'password')->passwordInput(['style' => 'border-radius: 4px;']) ?>

            <?= $form->field($model, 'nama')->textInput(['style' => 'border-radius: 4px;']) ?>

            <?= $form->field($model, 'no_hp')->textInput(['oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'style' => 'border-radius: 4px;']) ?>

            <?= $form->field($model, 'alamat')->textArea(['style' => 'border-radius: 4px;']) ?>

            <div class="form-group text-center" style="margin-bottom: 0 !important;">
                <?= Html::submitButton('Daftar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <a href="<?= Url::to('login'); ?>" class="btn btn-warning">Kembali</a>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- <div class="row" style="text-align: center;">
        <img src="<?= Url::to('@web/images/logo.png'); ?>" style="width: 30px;height: 40px;"><br>
        Copyright &copy; Badan Pendapatan Daerah Kota Kendari | 2020
    </div> -->
</div>
