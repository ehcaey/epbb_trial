<?php

use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ObjekPajak */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="input-permohonan-form">
    <?php
    if (Yii::$app->session->get('error')) {
    ?>
        <div class="alert alert-danger error-message">
            <?= Yii::$app->session->get('error') ?>
        </div>
        <?php
    }
    ?>
    
    <?php 
    
    $form = ActiveForm::begin(); 
    
    ?>
    
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label">Nomor Pelayanan</label>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-1">
                    <?= $form->field($modelPermohonan, 'thn_pelayanan')->textInput(['readonly' => true])->label(false) ?>
                </div>

                <div class="col-lg-1">
                    <?= $form->field($modelPermohonan, 'bundel_pelayanan')->textInput(['readonly' => true])->label(false) ?>
                </div>

                <div class="col-lg-1">
                    <?= $form->field($modelPermohonan, 'no_urut_pelayanan')->textInput(['readonly' => true])->label(false) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= 
                        
            $form->field($modelPermohonan, 'status_kolektif')->widget(Select2::class, [
                'theme' => Select2::THEME_DEFAULT,
                'data' => ArrayHelper::map($statusKolektifList, 'kd_lookup_item', 'nm_lookup_item'),
                'pluginLoading' => false,
                'pluginOptions' => [
                    'allowClear' => false,
                    'minimumResultsForSearch' => -1
                ],
            ]);
            
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($modelPermohonan, 'no_srt_permohonan')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= 
                        
            $form->field($modelPermohonanDetail, 'kd_jns_pelayanan')->widget(Select2::class, [
                'options' => ['placeholder' => 'Pilih jenis pelayanan...'],
                'theme' => Select2::THEME_DEFAULT,
                'data' => ArrayHelper::map($jenisPelayananList, 'kd_jns_pelayanan', 'nm_jenis_pelayanan'),
                'pluginLoading' => false,
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumResultsForSearch' => 0
                ],
            ]);
            
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3">
            <?= 
                        
            $form->field($modelPermohonan, 'tgl_surat_permohonan')->widget(DatePicker::class, [
                'removeButton' => false,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            
            ?>
        </div>
    </div>

    <?= $form->field($modelPermohonan, 'id_tujuan')->hiddenInput(['value' => 1])->label(false) ?>

    <div class="row">
        <div class="col-lg-12">
            <h5 class="panel-section-title">Data Wajib / Objek Pajak dan Keterangan</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <label class="control-label">NOP</label>
        </div>
    </div>

    <div id="nop" class="row">
        <div class="col-lg-1">
            <?= $form->field($modelPermohonanDetail, 'kd_propinsi_pemohon')->textInput(['maxlength' => true, 'readonly' => true, 'value' => Yii::$app->params['kd_provinsi']])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelPermohonanDetail, 'kd_dati2_pemohon')->textInput(['maxlength' => true, 'readonly' => true, 'value' => Yii::$app->params['kd_dati2']])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelPermohonanDetail, 'kd_kecamatan_pemohon')->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelPermohonanDetail, 'kd_kelurahan_pemohon')->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelPermohonanDetail, 'kd_blok_pemohon')->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelPermohonanDetail, 'no_urut_pemohon')->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= $form->field($modelPermohonanDetail, 'kd_jns_op_pemohon')->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
        </div>

        <div class="col-lg-1">
            <?= Html::button('<i class="fa fa-fw fa-search"></i>', ['class'=>'btn btn-warning btn-lookup-op btn-block']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($modelPermohonanDetail, 'thn_pajak_permohonan')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($modelPermohonan, 'nama_pemohon')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($modelPermohonan, 'alamat_pemohon')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($modelDataObjekPajakBaru, 'letak_op_baru')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($modelPermohonan, 'keterangan_pst')->textArea(['maxlength' => true, 'rows' => 3]) ?>
        </div>
    </div>

    <div id="pengurangan">
        <div class="row">
            <div class="col-lg-6">
                <?= 
                            
                $form->field($modelPermohonanPengurangan, 'jns_pengurangan')->widget(Select2::class, [
                    'options' => ['placeholder' => 'Pilih jenis pengurangan...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'data' => ArrayHelper::map($jenisPenguranganList, 'kd_lookup_item', 'nm_lookup_item'),
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'allowClear' => false,
                        'minimumResultsForSearch' => -1
                    ],
                ]);
                
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <?= 
                
                $form->field($modelPermohonanPengurangan, 'pct_permohonan_pengurangan', [
                    'addon' => [
                        'append' => [
                            'options' => ['content' => '%']
                        ]
                    ]
                ])->textInput(['maxlength' => true])->label('Persentase') 
                
                ?>
            </div>
        </div>
    </div>
    
    <div id="lampiran">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="panel-section-title">Lampiran Dokumen</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_permohonan')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>

            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_ktp_wp')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>

            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_sertifikat_tanah')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
            
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_sppt')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
            
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_imb')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
            
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_akte_jual_beli')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
            
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_sk_pensiun')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
            
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_sk_pengurangan')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
            
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_pbb_tetangga')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
            
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_pbb_induk')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
            
            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_foto_lokasi')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>

            <div class="col-lg-6">
                <?=

                $form->field($modelAttachmentPermohonan, 'l_spmkp_pbb')->widget(FileInput::className(), [
                    'pluginLoading' => false,
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                ]);

                ?>
            </div>
        </div>
        
        <hr>
    </div>

    <div class="form-group" style="margin-top: 20px;">
        <div class="pull-left">
            <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-fw fa-save']) . ' Simpan', ['class' => 'btn btn-success btn-save mr-5']) ?>
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-arrow-left']) . ' Kembali', ['index'], ['class' => 'btn btn-default']); ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php

Modal::begin([
    'header' => '<h4>Objek Pajak</h4>',
    'footer' => Html::button('<i class="fa fa-fw fa-times"></i> Tutup', ['class' => 'btn btn-default pull-right', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
    'options' => ['class' => 'fade modal-lookup-op'],
]);

Modal::end();

$getDataUrl = Url::to('@web/permohonan/lookup-objek-pajak');

$script = <<< JS
    $(function () {
        $('#pengurangan').hide();
        $('#lampiran').hide();

        $('form').on('keypress', function (e) {
            // Disable enter to submit form
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });

        $('#pstdetail-kd_jns_pelayanan').on('change.select2', function () {
            var jenisPelayanan = $(this).val();

            if (jenisPelayanan == '01') {
                $('#lampiran').show();
                
                $('#attachmentpermohonan-l_permohonan').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_ktp_wp').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_sertifikat_tanah').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_sppt').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_imb').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_akte_jual_beli').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_sk_pensiun').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_sk_pengurangan').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_pbb_tetangga').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_pbb_induk').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_foto_lokasi').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_spmkp_pbb').parents('.col-lg-6').hide();

                $('.btn-lookup-op').prop('disabled', true);

                $('#pstdetail-kd_kecamatan_pemohon').val('000');
                $('#pstdetail-kd_kelurahan_pemohon').val('000');
                $('#pstdetail-kd_blok_pemohon').val('000');
                $('#pstdetail-no_urut_pemohon').val('0000');
                $('#pstdetail-kd_jns_op_pemohon').val('0');

                $('#pstdataobjekpajakbaru-letak_op_baru').val('').prop('readonly', false);
            } else if (jenisPelayanan == '02') {
                $('#lampiran').show();
                
                $('#attachmentpermohonan-l_permohonan').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_ktp_wp').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_sertifikat_tanah').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_sppt').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_imb').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_akte_jual_beli').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_sk_pensiun').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_sk_pengurangan').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_pbb_tetangga').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_pbb_induk').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_foto_lokasi').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_spmkp_pbb').parents('.col-lg-6').hide();

                $('.btn-lookup-op').prop('disabled', false);
                
                $('#pstdataobjekpajakbaru-letak_op_baru').prop('readonly', true);
            } else if (jenisPelayanan == '08') {
                $('#lampiran').show();
                
                $('#attachmentpermohonan-l_permohonan').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_ktp_wp').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_sertifikat_tanah').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_sppt').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_imb').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_akte_jual_beli').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_sk_pensiun').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_sk_pengurangan').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_pbb_tetangga').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_pbb_induk').parents('.col-lg-6').hide();
                $('#attachmentpermohonan-l_foto_lokasi').parents('.col-lg-6').show();
                $('#attachmentpermohonan-l_spmkp_pbb').parents('.col-lg-6').show();

                $('.btn-lookup-op').prop('disabled', false);
                $('#pstdataobjekpajakbaru-letak_op_baru').prop('readonly', true);
            } else {
                $('#lampiran').hide();

                $('.btn-lookup-op').prop('disabled', false);
                $('#pstdataobjekpajakbaru-letak_op_baru').prop('readonly', true);
            }

            if (jenisPelayanan == '08' || jenisPelayanan == '10') {
                $('#pengurangan').show();

                if (jenisPelayanan == '08') {
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="1"]').prop('disabled', false);
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="2"]').prop('disabled', false);
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="3"]').prop('disabled', false);
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="4"]').prop('disabled', true);
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="5"]').prop('disabled', false);
                } else {
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="1"]').prop('disabled', true);
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="2"]').prop('disabled', true);
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="3"]').prop('disabled', true);
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="4"]').prop('disabled', false);
                    $('#pstpermohonanpengurangan-jns_pengurangan option[value="5"]').prop('disabled', true);
                }
            } else {
                $('#pengurangan').hide();
                $('#pstpermohonanpengurangan-jns_pengurangan').val('').trigger('change.select2');
            }
        });

        var lookupModal = $('.modal-lookup-op');

        $(".btn-lookup-op").on("click", function() {
            lookupModal.modal('show')
        });

        lookupModal.on('show.bs.modal', function (e) {
            let modal = $(this);
            modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>');
            
            $.ajax({
                url: '{$getDataUrl}',
                data: {},
                type: 'GET',
                dataType: 'html',
                success: function (data) {
                    modal.find('.modal-body').html(data);
                }
            });
        });

        lookupModal.on('click', '.btn-select-op', function () {
            var button = $(this);

            $('#pstdetail-kd_kecamatan_pemohon').val(button.data('kd_kecamatan'));
            $('#pstdetail-kd_kelurahan_pemohon').val(button.data('kd_kelurahan'));
            $('#pstdetail-kd_blok_pemohon').val(button.data('kd_blok'));
            $('#pstdetail-no_urut_pemohon').val(button.data('no_urut'));
            $('#pstdetail-kd_jns_op_pemohon').val(button.data('kd_jns_op'));
            $('#pstdataobjekpajakbaru-letak_op_baru').val(button.data('jalan_op'));

            lookupModal.modal('hide');
        });

        // $('.btn-process').on('click', function () {
        //     var nopInput = $('#nop input');
        //     var nop = '';

        //     $('.error-message').hide();
            
        //     $.each(nopInput, function (i, el) {
        //         if ($(el).val() == '') {
        //             $(el).parents('.form-group').addClass('has-error');
        //         } else {
        //             $(el).parents('.form-group').removeClass('has-error');
        //         }
        //         nop += $(el).val();
        //     });

        //     $(this).prop('disabled', true);
        //     $(this).html('<i class="fa fa-fw fa-spin fa-spinner"></i> Mencari...');

        //     var ajax = $.ajax({
        //         url: '{$getDataUrl}',
        //         data: {'nop': nop},
        //         dataType: 'json',
        //     })
        //     .done(function (result) {
        //         var data = result.data;
        //         var dataLetakOP = data.data_letak_objek_pajak;
        //         var dataSubjekPajak = data.data_subjek_pajak;
        //         var dataBumi = data.data_bumi;
        //         var dataBangunan = data.data_bangunan;
        //         var identitasPendata = data.identitas_pendata;
                
        //         // No. Formulir SPOP
        //         $('#objekpajak-no_formulir_spop').val(data.no_formulir_spop);

        //         // Data Letak Objek Pajak
        //         $('#objekpajak-jalan_op').val(dataLetakOP.jalan_op);
        //         $('#objekpajak-blok_kav_no_op').val(dataLetakOP.blok_kav_no_op);
        //         $('#kelurahan-nm_kelurahan').val(dataLetakOP.nm_kelurahan);
        //         $('#objekpajak-rw_op').val(dataLetakOP.rw_op);
        //         $('#objekpajak-rt_op').val(dataLetakOP.rt_op);
        //         $('#objekpajak-no_persil').val(dataLetakOP.no_persil);

        //         // Data Subjek Pajak
        //         $('#subjekpajak-subjek_pajak_id').val(dataSubjekPajak.subjek_pajak_id);
        //         $('#subjekpajak-status_pekerjaan_wp').val(dataSubjekPajak.status_pekerjaan_wp);
        //         $('#subjekpajak-nm_wp').val(dataSubjekPajak.nm_wp);
        //         $('#objekpajak-kd_status_wp').val(dataSubjekPajak.status_wp);
        //         $('#subjekpajak-jalan_wp').val(dataSubjekPajak.jalan_wp);
        //         $('#subjekpajak-npwp').val(dataSubjekPajak.npwp);
        //         $('#subjekpajak-blok_kav_no_wp').val(dataSubjekPajak.blok_kav_no_wp);
        //         $('#subjekpajak-rt_wp').val(dataSubjekPajak.rt_wp);
        //         $('#subjekpajak-rw_wp').val(dataSubjekPajak.rw_wp);
        //         $('#subjekpajak-kelurahan_wp').val(dataSubjekPajak.kelurahan_wp);
        //         $('#subjekpajak-kota_wp').val(dataSubjekPajak.kota_wp);
        //         $('#subjekpajak-kd_pos_wp').val(dataSubjekPajak.kd_pos_wp);
        //         $('#subjekpajak-telp_wp').val(dataSubjekPajak.telp_wp);

        //         // Data Bumi
        //         $('#opbumi-luas_bumi').val(dataBumi.luas_bumi);
        //         $('#opbumi-kd_znt').val(dataBumi.kd_znt);
        //         $('#jenistanah-nama').val(dataBumi.jns_bumi);

        //         // Data Bangunan
        //         $('#opbangunan-jumlah').val(dataBangunan.jumlah_bangunan);

        //         // Identitas Pendata
        //         $('#objekpajak-tgl_pendataan_op').val(identitasPendata.tgl_pendataan_op);
        //         $('#objekpajak-tgl_pemeriksaan_op').val(identitasPendata.tgl_pemeriksaan_op);
        //         $('#objekpajak-tgl_perekaman_op').val(identitasPendata.tgl_perekaman_op);
        //         $('#objekpajak-nip_pendata').val(identitasPendata.nip_pendata);
        //         $('#objekpajak-nip_pemeriksa_op').val(identitasPendata.nip_pemeriksa_op);
        //         $('#objekpajak-nip_perekam_op').val(identitasPendata.nip_perekam_op);
        //     })
        //     .fail(function (result) {
        //         $('.error-message').show();
        //         $('.error-message').html(result.responseJSON.message);
        //     })
        //     .always(function (result) {
        //         $('.btn-process').prop('disabled', false);
        //         $('.btn-process').html('Cari <i class="fa fa-fw fa-search"></i>');
        //     });
        // });
    })
JS;

$this->registerJs($script);