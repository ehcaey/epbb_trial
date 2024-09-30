<?php

use Carbon\Carbon;
use kartik\form\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjekPajakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail';
$this->params['breadcrumbs'][] = ['label' => 'Ketetapan & Piutang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $objekPajak->nop;

?>

<div class="dat-objek-pajak-index">
    <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $this->title ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label class="control-label">NOP</label>
                    </div>
                </div>
                <div id="nop">
                    <div class="row">
                        <div class="col-lg-1">
                            <?= $form->field($objekPajak, 'kd_propinsi')->textInput(['readonly' => true, 'value' => Yii::$app->params['kd_provinsi']])->label(false) ?>
                        </div>

                        <div class="col-lg-1">
                            <?= $form->field($objekPajak, 'kd_dati2')->textInput(['readonly' => true, 'value' => Yii::$app->params['kd_dati2']])->label(false) ?>
                        </div>

                        <div class="col-lg-1">
                            <?= $form->field($objekPajak, 'kd_kecamatan')->textInput(['readonly' => true])->label(false) ?>
                        </div>

                        <div class="col-lg-1">
                            <?= $form->field($objekPajak, 'kd_kelurahan')->textInput(['readonly' => true])->label(false) ?>
                        </div>

                        <div class="col-lg-1">
                            <?= $form->field($objekPajak, 'kd_blok')->textInput(['readonly' => true])->label(false) ?>
                        </div>

                        <div class="col-lg-1">
                            <?= $form->field($objekPajak, 'no_urut')->textInput(['readonly' => true])->label(false) ?>
                        </div>

                        <div class="col-lg-1">
                            <?= $form->field($objekPajak, 'kd_jns_op')->textInput(['readonly' => true])->label(false) ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($objekPajak, 'nm_wp')->textInput(['readonly' => true, 'value' => $objekPajak->subjekPajak->nm_wp])->label('NAMA WAJIB PAJAK') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($objekPajak, 'jalan_op')->textInput(['readonly' => true, 'value' => $objekPajak->jalan_op])->label('JALAN OBJEK PAJAK') ?>
                    </div>

                    <div class="col-lg-6">
                        <?= $form->field($objekPajak, 'blok_kav_no_op')->textInput(['readonly' => true, 'value' => $objekPajak->blok_kav_no_op])->label('BLOK/KAV/NO OBJEK PAJAK') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($objekPajak, 'jalan_wp')->textInput(['readonly' => true, 'value' => $objekPajak->subjekPajak->jalan_wp])->label('JALAN WAJIB PAJAK') ?>
                    </div>
                    
                    <div class="col-lg-6">
                        <?= $form->field($objekPajak, 'blok_kav_no_wp')->textInput(['readonly' => true, 'value' => $objekPajak->subjekPajak->blok_kav_no_wp])->label('BLOK/KAV/NO WAJIB PAJAK') ?>
                    </div>
                </div>

                <hr style="margin-top: 15px;margin-bottom: 15px;">
                
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="panel-section-title">Piutang PBB</h5>
                    </div>
                </div>
                <table id="sppt-table" class="table table-bordered table-striped table-hover" style="margin-bottom: 0px;margin-top: 0px;">
                    <thead>
                        <tr>
                            <th>Tahun Pajak</th>
                            <th>Jumlah Pajak</th>
                            <th>Jatuh Tempo</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Pembayaran</th>
                            <th class="text-center">Cetak</th>
                            <th class="text-center">Pilih</th>
                        </tr>
                    </thead>
                        
                    <tbody>
                        <?php 

                        foreach ($objekPajak->sppt as $sppt) {
                            ?>
                            <tr>
                                <td>
                                    <?= $sppt->thn_pajak_sppt ?>
                                </td>
                                <td>
                                    <?= number_format($sppt->pbb_yg_harus_dibayar_sppt, 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?= Carbon::createFromFormat('Y-m-d H:i:s', $sppt->tgl_jatuh_tempo_sppt)->format('d/m/Y') ?>
                                </td>
                                <td>
                                    <?= ($sppt->status_pembayaran_sppt == '0') ? 'BELUM LUNAS' : 'LUNAS' ?>
                                </td>
                                <td>
                                    <?= ($sppt->pembayaran != null) ? Carbon::createFromFormat('Y-m-d H:i:s', $sppt->pembayaran->tgl_pembayaran_sppt)->format('d/m/Y') : '' ?>
                                </td>
                                <td class="text-center">
                                    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-print']), Url::to('/ketetapan/cetak-sppt?nop=' . $nop . '&thn_pajak_sppt=' . $sppt->thn_pajak_sppt), ['target' => '_blank']); ?>
                                </td>
                                <td class="text-center">
                                    <?= ($sppt->status_pembayaran_sppt == '0') ? '<input type="checkbox" name="sppt[' . $sppt->thn_pajak_sppt . ']">' : '' ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <hr>

                <div class="row">
                    <div class="col-lg-2 col-lg-offset-10">
                        <div class="form-group text-right">
                            <?= Html::button('Bayar', ['class' => 'btn btn-success btn-confirm-payment mr-5', 'disabled' => true]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<?php

Modal::begin([
    'header' => '<h4>Konfirmasi Pembayaran</h4>',
    'footer' => Html::button('Bayar', ['class' => 'btn btn-success pull-right btn-confirm', 'style' => 'margin-left: 10px;']) . Html::button('<i class="fa fa-fw fa-times"></i> Batal', ['class' => 'btn btn-default pull-right', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
    'options' => ['class' => 'fade modal-konfirmasi'],
]);

Modal::end();

$konfirmasiPembayaranUrl = Url::to('@web/ketetapan/konfirmasi-pembayaran');
$getVirtualAccountUrl = Url::to('@web/ketetapan/get-virtual-account');

$script = <<< JS
    $(function () {
        $('#sppt-table input[type="checkbox"]').click(function () {
            var numChecked = $('#sppt-table input[type="checkbox"]:checked').length;
            var btnPay = $('.btn-confirm-payment');

            if (numChecked) {
                btnPay.prop('disabled', false).html('Bayar ' + '(' + numChecked + ')');
            } else {
                btnPay.prop('disabled', true).html('Bayar');
            }
        });

        var modalPembayaran = $('.modal-konfirmasi');

        $('.btn-confirm-payment').click(function () {
            modalPembayaran.modal('show');
        });

        modalPembayaran.on('show.bs.modal', function (e) {
            let modal = $(this);
            modal.find('.modal-body').html('<div style=\"text-align: center\"><i class=\"fa fa-2x fa-spinner fa-spin\"></i></div>');
            
            let tahunPajak = $('#sppt-table input[type="checkbox"]:checked').serialize();

            $('.btn-confirm').prop('disabled', true);
            $.ajax({
                url: '{$konfirmasiPembayaranUrl}',
                data: tahunPajak + '&ObjekPajak[kd_propinsi]={$objekPajak->kd_propinsi}&ObjekPajak[kd_dati2]={$objekPajak->kd_dati2}&ObjekPajak[kd_kecamatan]={$objekPajak->kd_kecamatan}&ObjekPajak[kd_kelurahan]={$objekPajak->kd_kelurahan}&ObjekPajak[kd_blok]={$objekPajak->kd_blok}&ObjekPajak[no_urut]={$objekPajak->no_urut}&ObjekPajak[kd_jns_op]={$objekPajak->kd_jns_op}',
                type: 'GET',
                dataType: 'html',
                success: function (data) {
                    $('.btn-confirm').prop('disabled', false);
                    modal.find('.modal-body').html(data);
                },
                error: function (response) {
                    modal.find('.modal-body').html('Terjadi kesalahan, coba lagi.')
                }
            });
        });

        $('.btn-confirm').click(function () {
            modalPembayaran.find('.modal-body').html('<div style=\"text-align: center\"><i class=\"fa fa-2x fa-spinner fa-spin\"></i></div>');
            
            $(this).prop('disabled', true);

            let tahunPajak = $('#sppt-table input[type="checkbox"]:checked').serialize();

            $.ajax({
                url: '{$getVirtualAccountUrl}',
                data: tahunPajak + '&ObjekPajak[kd_propinsi]={$objekPajak->kd_propinsi}&ObjekPajak[kd_dati2]={$objekPajak->kd_dati2}&ObjekPajak[kd_kecamatan]={$objekPajak->kd_kecamatan}&ObjekPajak[kd_kelurahan]={$objekPajak->kd_kelurahan}&ObjekPajak[kd_blok]={$objekPajak->kd_blok}&ObjekPajak[no_urut]={$objekPajak->no_urut}&ObjekPajak[kd_jns_op]={$objekPajak->kd_jns_op}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.resultcode == '00') {
                        modalPembayaran.find('.modal-body').html('<h4 class="text-center">Nomor Virtual Account</h4><h3 class="text-center"><strong>' + data.nova + '</strong></h3>');
                    } else {
                        modalPembayaran.find('.modal-body').html('<h4 class="text-center">' + data.result + '</h4>');
                    }
                },
                error: function (response) {
                    modalPembayaran.find('.modal-body').html('Terjadi kesalahan saat membuat nomor pembayaran.');
                }
            });
        });
    });
JS;

$this->registerJs($script);