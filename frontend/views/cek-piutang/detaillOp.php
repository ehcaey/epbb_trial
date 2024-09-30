<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<div class="center">
  <div class="wrap">
    <div class="logo">
      <img src="<?= Url::to('@web/images/logo.png'); ?>" class="gambar-pwk" alt="">
      <div style="margin-left: 20px; padding-top: 0;">
        <h4 class="text-uppercase">badan pendapatan daerah kendari</h4>
        <p class="text-uppercase">cek piutang pbb anda</p>
      </div>
    </div>

    <div class="nop">
      <div class="nop-search">
        <?php $form = ActiveForm::begin(['id' => 'search-form']); ?>

        <?= $form->field($model, 'nop')->textInput(['maxlength' => true])->label('NOP') ?>

        <div class="form-group">
          <?= Html::button('Cari', [
            'class' => 'btn btn-primary',
            'id' => 'search-button',
          ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>

  <div class="footer">
    <h5>E-PBB © 2023</h5>
  </div>
</div>

<?php
  $getDataUrl = Url::to('@web/cek-piutang/search');

  $script = <<< JS
  $('#search-button').on('click', function () {
   
    var nop = $('#objekpajaksearch-nop').val();
    var kd_kecamatan = nop.substring(0, 2);
    var kd_kelurahan = nop.substring(2, 4);
    var no_urut = nop.substring(4, 6);

    // alert(kd_kecamatan);die;
    $.ajax({
        url: '$getDataUrl',
        type: 'post',
        data: { kd_kecamatan: kd_kecamatan, kd_kelurahan: kd_kelurahan, no_urut: no_urut },
        success: function (response) {
            // Redirect ke halaman detail jika data ditemukan
            if (response.redirect) {
                window.location.href = response.redirect;
            } else {
                console.log('Redirect URL not provided in response.');
            }
        },
        error: function (error) {
            console.log('Error: ' + error);
        }
    });
  })

  JS;

  $this->registerJs($script);
?>
