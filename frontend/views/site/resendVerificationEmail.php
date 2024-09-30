<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Resend verification email';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box" style="width: 500px;">
    <div class="login-logo">
        <a href="#"><b>E-PBB<br>Kota Kendari</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Request E-mail Verifikasi</p>
        <p>Silahkan isi e-mail yang Anda gunakan untuk melakukan pendaftaran. E-mail verifikasi akan dikirim ulang ke e-mail yang Anda isi.</p>

        <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?> 
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: center;">
                <div class="form-group">
                    <?= Html::submitButton('Kirim', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Html::tag('i', '', ['class' => '']) . ' Kembali', ['index'], ['class' => 'btn btn-default']); ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <br>
    <div class="row" style="text-align: center;">
        <img src="<?= Url::to('@web/images/logo.png'); ?>" style="width: 30px;height: 40px;"><br>
        Copyright &copy; Badan Pendapatan Daerah Kota Kendari | 2020
    </div>
</div>
