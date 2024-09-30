<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;

/* @var $this \yii\web\View */
/* @var $content string */

foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
  echo Alert::widget([
    'options' => ['class' => 'alert-danger'], // Sesuaikan dengan kelas CSS yang Anda gunakan
    'body' => $message,
  ]);
}

// Tombol untuk membuka modal
// echo Html::button('Login', ['class' => 'btn btn-success', 'id' => 'open-login-modal-button']);

Modal::begin([
  'header' => '<h2>Login</h2>',
  'id' => 'login-modal',
  'size' => 'modal-sm',
]);

$form = ActiveForm::begin([
  'id' => 'login-form',
  'enableAjaxValidation' => true,
  'enableClientValidation' => false,
  'validateOnBlur' => false,
  'validateOnChange' => false,
  'validateOnSubmit' => true,
]);

// echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']);

ActiveForm::end();

Modal::end();

dmstr\web\AdminLteAsset::register($this);
?>
<div class="center">
  <div class="wrap">
    <div class="logo">
      <img src="<?= Url::to('@web/images/logo.png'); ?>" class="logo-img" alt="">
      <div style="margin-left: 20px; padding-top: 0;">
        <h3 class="text-uppercase">badan pendapatan daerah</h4>
          <h3 class="text-uppercase" style="margin-top: 0px;">kota kendari</h3>
          <h4 class="text-uppercase" style="margin-top: 0px;">cek pbb anda</h4>
          <!-- <a href="<?= Url::to('@web/nop-wilayah/index') ?>" class="text-center"><button
              class="btn btn-success btn-block text-uppercase">Cari NOP per Wilayah</button></a> -->
      </div>
    </div>

    <div class="nop">
      <div class="nop-search">
        <?php $form = ActiveForm::begin(['action' => Url::to('@web/cek-piutang/detail'), 'method' => 'get', 'id' => 'search-form']); ?>

        <input type="text" name="nop" class="input-nop" id="searchInput" placeholder="Masukkan NOP">

        <?= Html::button('<i class="fa fa-search"></i> Search', [
          'class' => 'btn btn-danger',
          'id' => 'search-button',
          'type' => 'submit'
        ]) ?>

        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>

  <div class="footer">
    <h5>E-PBB © 2023</h5>
  </div>
</div>

<?php
$script = <<<JS
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);

        document.getElementById('searchInput').addEventListener('input', formatInput);
        document.getElementById('searchInput').addEventListener('paste', handlePaste);

        function formatInput(event) {
            let input = event.target;
            let value = input.value;

            // Hapus semua karakter non-digit
            value = value.replace(/\D/g, '');

            // Batasi panjang maksimal ke 18 digit
            if (value.length > 18) {
                value = value.substring(0, 18);
            }

            // Update nilai input field
            input.value = value;
        }

        function handlePaste(event) {
            event.preventDefault();

            // Dapatkan teks yang di-paste
            let paste = (event.clipboardData || window.clipboardData).getData('text');

            // Hapus semua karakter non-digit
            paste = paste.replace(/\D/g, '');

            // Batasi panjang maksimal ke 18 digit
            if (paste.length > 18) {
                paste = paste.substring(0, 18);
            }

            // Masukkan teks yang telah diformat ke dalam input field
            document.getElementById('searchInput').value = paste;

            // Panggil fungsi formatInput untuk memastikan input sesuai
            formatInput({ target: document.getElementById('searchInput') });
        }
    });
JS;

$this->registerJs("
    $('#open-login-modal-button').click(function(){
        $('#login-modal').modal('show');
    });

    $('#login-form').on('beforeSubmit', function (e) {
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function (data) {
                // Handle the response (redirect, display messages, etc.)
                $('#login-modal').modal('hide');
            }
        });
        return false;
    });
");


$this->registerJs($script);
?>