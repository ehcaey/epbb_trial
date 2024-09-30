<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SubjekPajakSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subjek-pajak-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'subjek_pajak_id') ?>

    <?= $form->field($model, 'nm_wp') ?>

    <?= $form->field($model, 'jalan_wp') ?>

    <?= $form->field($model, 'blok_kav_no_wp') ?>

    <?= $form->field($model, 'rw_wp') ?>

    <?php // echo $form->field($model, 'rt_wp') ?>

    <?php // echo $form->field($model, 'kelurahan_wp') ?>

    <?php // echo $form->field($model, 'kota_wp') ?>

    <?php // echo $form->field($model, 'kd_pos_wp') ?>

    <?php // echo $form->field($model, 'telp_wp') ?>

    <?php // echo $form->field($model, 'npwp') ?>

    <?php // echo $form->field($model, 'status_pekerjaan_wp') ?>

    <?php // echo $form->field($model, 'createdby') ?>

    <?php // echo $form->field($model, 'createdtime') ?>

    <?php // echo $form->field($model, 'updatedby') ?>

    <?php // echo $form->field($model, 'updatedtime') ?>

    <?php // echo $form->field($model, 'handphone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
