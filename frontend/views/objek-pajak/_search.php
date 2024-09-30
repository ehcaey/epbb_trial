<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObjekPajakSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dat-objek-pajak-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'kd_propinsi') ?>

    <?= $form->field($model, 'kd_dati2') ?>

    <?= $form->field($model, 'kd_kecamatan') ?>

    <?= $form->field($model, 'kd_kelurahan') ?>

    <?= $form->field($model, 'kd_blok') ?>

    <?php // echo $form->field($model, 'no_urut') ?>

    <?php // echo $form->field($model, 'kd_jns_op') ?>

    <?php // echo $form->field($model, 'subjek_pajak_id') ?>

    <?php // echo $form->field($model, 'no_formulir_spop') ?>

    <?php // echo $form->field($model, 'no_persil') ?>

    <?php // echo $form->field($model, 'jalan_op') ?>

    <?php // echo $form->field($model, 'blok_kav_no_op') ?>

    <?php // echo $form->field($model, 'rw_op') ?>

    <?php // echo $form->field($model, 'rt_op') ?>

    <?php // echo $form->field($model, 'kd_status_cabang') ?>

    <?php // echo $form->field($model, 'kd_status_wp') ?>

    <?php // echo $form->field($model, 'total_luas_bumi') ?>

    <?php // echo $form->field($model, 'total_luas_bng') ?>

    <?php // echo $form->field($model, 'njop_bumi') ?>

    <?php // echo $form->field($model, 'njop_bng') ?>

    <?php // echo $form->field($model, 'status_peta_op') ?>

    <?php // echo $form->field($model, 'jns_transaksi_op') ?>

    <?php // echo $form->field($model, 'tgl_pendataan_op') ?>

    <?php // echo $form->field($model, 'nip_pendata') ?>

    <?php // echo $form->field($model, 'tgl_pemeriksaan_op') ?>

    <?php // echo $form->field($model, 'nip_pemeriksa_op') ?>

    <?php // echo $form->field($model, 'tgl_perekaman_op') ?>

    <?php // echo $form->field($model, 'nip_perekam_op') ?>

    <?php // echo $form->field($model, 'createdby') ?>

    <?php // echo $form->field($model, 'createdtime') ?>

    <?php // echo $form->field($model, 'updatedby') ?>

    <?php // echo $form->field($model, 'updatedtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
