<?php

use kartik\checkbox\CheckboxX;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ObjekPajak */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tambah-objek-pajak-form">
    <div class="alert alert-danger error-message" style="display: none;">
        
    </div>
    <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>

    <div class="row">
        <div class="col-lg-12">
            <label class="control-label">NOP</label>
        </div>
    </div>

    <div id="nop" class="row">
        <div class="col-lg-1">
            <?= $form->field($modelObjekPajak, 'kd_propinsi')->textInput(['maxlength' => true, 'readonly' => true, 'value' => Yii::$app->params['kd_provinsi']])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelObjekPajak, 'kd_dati2')->textInput(['maxlength' => true, 'readonly' => true, 'value' => Yii::$app->params['kd_dati2']])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelObjekPajak, 'kd_kecamatan')->textInput(['maxlength' => true, 'autofocus' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelObjekPajak, 'kd_kelurahan')->textInput(['maxlength' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelObjekPajak, 'kd_blok')->textInput(['maxlength' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelObjekPajak, 'no_urut')->textInput(['maxlength' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelObjekPajak, 'kd_jns_op')->textInput(['maxlength' => true])->label(false) ?>
        </div>

        <div class="col-lg-5">
            <div class="form-group">
                <div class="pull-left">
                    <?= Html::button('Cari ' . Html::tag('i', '', ['class' => 'fa fa-fw fa-search']), ['class' => 'btn btn-primary btn-process']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($modelObjekPajak, 'no_formulir_spop')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
    </div>
    
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <h5 class="panel-section-title">Data Letak Objek Pajak</h5>
        </div>
        
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelObjekPajak, 'jalan_op')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-6">
                    <?= $form->field($modelObjekPajak, 'blok_kav_no_op')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelKelurahan, 'nm_kelurahan')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($modelObjekPajak, 'rt_op')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($modelObjekPajak, 'rw_op')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
                <?= $form->field($modelObjekPajak, 'no_persil')->textInput(['readonly' => true]) ?>
        </div>
    </div>
    
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <h5 class="panel-section-title">Data Subjek Pajak</h5>
        </div>
        
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'subjek_pajak_id', ['showRequiredIndicator' => false])->textInput(['readonly' => true])->label('NIK') ?>
                </div>

                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'status_pekerjaan_wp')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'nm_wp')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-6">
                    <?= $form->field($modelObjekPajak, 'kd_status_wp')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'jalan_wp')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'npwp')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'blok_kav_no_wp')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($modelSubjekPajak, 'rt_wp')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($modelSubjekPajak, 'rw_wp')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'kelurahan_wp')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'kota_wp')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'kd_pos_wp')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-6">
                    <?= $form->field($modelSubjekPajak, 'telp_wp')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <h5 class="panel-section-title">Data Bumi</h5>
        </div>
        
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($modelOpBumi, 'luas_bumi')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($modelOpBumi, 'kd_znt')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($modelJenisTanah, 'nama', ['showRequiredIndicator' => false])->textInput(['readonly' => true])->label('Jenis Bumi') ?>
                </div>
            </div>
        </div>
    </div>
    
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <h5 class="panel-section-title">Data Bangunan</h5>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($modelOpBangunan, 'jumlah')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <h5 class="panel-section-title">Identitas Pendata</h5>
        </div>
        
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($modelObjekPajak, 'tgl_pendataan_op')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($modelObjekPajak, 'tgl_pemeriksaan_op')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($modelObjekPajak, 'tgl_perekaman_op')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($modelObjekPajak, 'nip_pendata')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($modelObjekPajak, 'nip_pemeriksa_op')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($modelObjekPajak, 'nip_perekam_op')->textInput(['readonly' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <hr/>

    <div class="form-group" style="margin-top: 20px;">
        <div class="pull-left">
            <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-fw fa-save']) . ' Simpan', ['class' => 'btn btn-success btn-save mr-5', 'disabled' => true]) ?>
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-arrow-left']) . ' Kembali', ['index'], ['class' => 'btn btn-default']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$getDataUrl = Url::to('@web/objek-pajak/get-data-objek-pajak');

$script = <<< JS
    $(function () {
        $('form').on('keypress', function (e) {
            // Disable enter to submit form
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });

        $('#nop input:not([readonly])').autotab('number');

        $('#nop input:not([readonly])').on('keyup', function (e) {
            this.value = $(this).val().replace(/[^\d]/g,'');
        });

        // $('#confirmation').change(function () {
        //     if ($(this).val() == '1') {
        //         $('.btn-save').prop('disabled', false);
        //     } else {
        //         $('.btn-save').prop('disabled', true);
        //     }
        // });

        $('.btn-process').on('click', function () {
            var nopInput = $('#nop input');
            var nop = '';

            $('.error-message').hide();
            
            $.each(nopInput, function (i, el) {
                if ($(el).val() == '') {
                    $(el).parents('.form-group').addClass('has-error');
                } else {
                    $(el).parents('.form-group').removeClass('has-error');
                }
                nop += $(el).val();
            });

            $(this).prop('disabled', true);
            $(this).html('<i class="fa fa-fw fa-spin fa-spinner"></i> Mencari...');

            var ajax = $.ajax({
                url: '{$getDataUrl}',
                data: {'nop': nop},
                dataType: 'json',
            })
            .done(function (result) {
                var data = result.data;
                var dataLetakOP = data.data_letak_objek_pajak;
                var dataSubjekPajak = data.data_subjek_pajak;
                var dataBumi = data.data_bumi;
                var dataBangunan = data.data_bangunan;
                var identitasPendata = data.identitas_pendata;
                
                // No. Formulir SPOP
                $('#objekpajak-no_formulir_spop').val(data.no_formulir_spop);

                // Data Letak Objek Pajak
                $('#objekpajak-jalan_op').val(dataLetakOP.jalan_op);
                $('#objekpajak-blok_kav_no_op').val(dataLetakOP.blok_kav_no_op);
                $('#kelurahan-nm_kelurahan').val(dataLetakOP.nm_kelurahan);
                $('#objekpajak-rw_op').val(dataLetakOP.rw_op);
                $('#objekpajak-rt_op').val(dataLetakOP.rt_op);
                $('#objekpajak-no_persil').val(dataLetakOP.no_persil);

                // Data Subjek Pajak
                $('#subjekpajak-subjek_pajak_id').val(dataSubjekPajak.subjek_pajak_id);
                $('#subjekpajak-status_pekerjaan_wp').val(dataSubjekPajak.status_pekerjaan_wp);
                $('#subjekpajak-nm_wp').val(dataSubjekPajak.nm_wp);
                $('#objekpajak-kd_status_wp').val(dataSubjekPajak.status_wp);
                $('#subjekpajak-jalan_wp').val(dataSubjekPajak.jalan_wp);
                $('#subjekpajak-npwp').val(dataSubjekPajak.npwp);
                $('#subjekpajak-blok_kav_no_wp').val(dataSubjekPajak.blok_kav_no_wp);
                $('#subjekpajak-rt_wp').val(dataSubjekPajak.rt_wp);
                $('#subjekpajak-rw_wp').val(dataSubjekPajak.rw_wp);
                $('#subjekpajak-kelurahan_wp').val(dataSubjekPajak.kelurahan_wp);
                $('#subjekpajak-kota_wp').val(dataSubjekPajak.kota_wp);
                $('#subjekpajak-kd_pos_wp').val(dataSubjekPajak.kd_pos_wp);
                $('#subjekpajak-telp_wp').val(dataSubjekPajak.telp_wp);

                // Data Bumi
                $('#opbumi-luas_bumi').val(dataBumi.luas_bumi);
                $('#opbumi-kd_znt').val(dataBumi.kd_znt);
                $('#jenistanah-nama').val(dataBumi.jns_bumi);

                // Data Bangunan
                $('#opbangunan-jumlah').val(dataBangunan.jumlah_bangunan);

                // Identitas Pendata
                $('#objekpajak-tgl_pendataan_op').val(identitasPendata.tgl_pendataan_op);
                $('#objekpajak-tgl_pemeriksaan_op').val(identitasPendata.tgl_pemeriksaan_op);
                $('#objekpajak-tgl_perekaman_op').val(identitasPendata.tgl_perekaman_op);
                $('#objekpajak-nip_pendata').val(identitasPendata.nip_pendata);
                $('#objekpajak-nip_pemeriksa_op').val(identitasPendata.nip_pemeriksa_op);
                $('#objekpajak-nip_perekam_op').val(identitasPendata.nip_perekam_op);

                $('.btn-save').prop('disabled', false);
            })
            .fail(function (result) {
                $('.error-message').show();
                $('.error-message').html(result.responseJSON.message);

                $('.btn-save').prop('disabled', true);
            })
            .always(function (result) {
                $('.btn-process').prop('disabled', false);
                $('.btn-process').html('Cari <i class="fa fa-fw fa-search"></i>');
            });
        });
    })
JS;

$this->registerJs($script);