<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\SubjekPajak */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

$getDataWP = Url::to('@web/subjek-pajak/get-data-wp');
$simpanData = Url::to('@web/subjek-pajak/simpan');

$script = <<< JS

    $(function(){

        $(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
        var subjek_pajak_id = $('#subjekpajak-subjek_pajak_id').val();
        if(subjek_pajak_id != ''){
            $('#edit').show();
            $('#subjekpajak-subjek_pajak_id').prop('disabled', true);
            $('#subjekpajak-kota_wp').prop('disabled', true);
            $('#subjekpajak-nm_wp').prop('disabled', true);
            $('#subjekpajak-kelurahan_wp').prop('disabled', true);
            $('#subjekpajak-npwp').prop('disabled', true);
            $('#subjekpajak-rt_wp').prop('disabled', true);
            $('#subjekpajak-rw_wp').prop('disabled', true);
            $('#subjekpajak-status_pekerjaan_wp').prop('disabled', true);
            $('#subjekpajak-jalan_wp').prop('disabled', true);
            $('#subjekpajak-telp_wp').prop('disabled', true);
            $('#subjekpajak-blok_kav_no_wp').prop('disabled', true);
            $('#subjekpajak-handphone').prop('disabled', true);
            $('#subjekpajak-kd_pos_wp').prop('disabled', true);
        }else{
            $('#simpan').show();
            $('#kembali').show();
            $('#simpan').prop('disabled', true);
        }
        
        $('form').on('keypress', function (e) {
            // Disable enter to submit form
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
        
        // $('#subjekpajak-subjek_pajak_id').on('keyup', function(){
        //     getwp();
        // });

        $('#subjekpajak-subjek_pajak_id').on('focusout', function(){
            getwp();
        });

        function getwp(){
            if($('#subjekpajak-subjek_pajak_id').val().length == 16){
                var spin = document.getElementById("spin");
                spin.setAttribute("class","fa fa-fw fa-spin fa-spinner");
                $.ajax({
                    url: '{$getDataWP}',
                    data: {'nik': $('#subjekpajak-subjek_pajak_id').val()},
                    type: 'POST',
                    success : function(data){
                        if(data != 1){
                            spin.setAttribute("class","");
                            var d = JSON.parse(data);
                            $('#subjekpajak-nm_wp').val(d.nm_wp);
                            $('#subjekpajak-kota_wp').val(d.kota_wp);
                            $('#subjekpajak-kelurahan_wp').val(d.kelurahan_wp);
                            $('#subjekpajak-rt_wp').val(d.rt_wp);
                            $('#subjekpajak-rw_wp').val(d.rw_wp);
                            $('#subjekpajak-npwp').val(d.npwp);
                            $('#subjekpajak-jalan_wp').val(d.jalan_wp);
                            $('#subjekpajak-telp_wp').val(d.telp_wp);
                            $('#subjekpajak-blok_kav_no_wp').val(d.blok_kav_no_wp);
                            $('#subjekpajak-handphone').val(d.handphone);
                            $('#subjekpajak-kd_pos_wp').val(d.kd_pos_wp);
                            $('#subjekpajak-status_pekerjaan_wp').val(d.status_pekerjaan_wp + ' ').trigger('change.select2').change();
                            $('#simpan').prop('disabled', false);
                            $('#subjekpajak-subjek_pajak_id').prop('readonly', true);
                        }else{
                            spin.setAttribute("class","");
                            $('#subjekpajak-nm_wp').val("");
                            $('#subjekpajak-kota_wp').val("");
                            $('#subjekpajak-kelurahan_wp').val("");
                            $('#subjekpajak-rt_wp').val("");
                            $('#subjekpajak-rw_wp').val("");
                            $('#subjekpajak-npwp').val("");
                            $('#subjekpajak-jalan_wp').val("");
                            $('#subjekpajak-telp_wp').val("");
                            $('#subjekpajak-blok_kav_no_wp').val("");
                            $('#subjekpajak-handphone').val("");
                            $('#subjekpajak-kd_pos_wp').val("");
                            $('#subjekpajak-status_pekerjaan_wp').val("").trigger('change.select2').change();
                        }
                    }
                });
            }
        }

        $('#edit').click(function(){
            $('#subjekpajak-subjek_pajak_id').prop('disabled', false);
            $('#subjekpajak-kota_wp').prop('disabled', false);
            $('#subjekpajak-nm_wp').prop('disabled', false);
            $('#subjekpajak-kelurahan_wp').prop('disabled', false);
            $('#subjekpajak-npwp').prop('disabled', false);
            $('#subjekpajak-rt_wp').prop('disabled', false);
            $('#subjekpajak-rw_wp').prop('disabled', false);
            $('#subjekpajak-status_pekerjaan_wp').prop('disabled', false);
            $('#subjekpajak-jalan_wp').prop('disabled', false);
            $('#subjekpajak-telp_wp').prop('disabled', false);
            $('#subjekpajak-blok_kav_no_wp').prop('disabled', false);
            $('#subjekpajak-handphone').prop('disabled', false)
            $('#subjekpajak-kd_pos_wp').prop('disabled', false);
            $('#simpan').show();
            $('#kembali').show();
            $('#edit').hide();
        });
    });
JS;

$this->registerJs($script);

?>
<div class="subjek-pajak-form">

    <?php $form = ActiveForm::begin(['id' => 'form', 'options' => ['method' => 'post']]); ?>

    <div class="row">

        <div class="col-lg-12">
            <h5 class="panel-section-title">Data Wajib Pajak</h5>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'subjek_pajak_id',['addon' => ['append' => ['options' => ['style' => 'border-left-style: 0;'],'content'=>'<i id="spin"></i>']]])->textInput(['maxlength' => 16, 'style' => 'border-right-style: none;','oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'kota_wp')->textInput(['maxlength' => true]) ?>
                </div>
            </div>    
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'nm_wp')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'kelurahan_wp')->textInput(['maxlength' => true]) ?>
                </div>
            </div>    
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($model, 'rt_wp')->textInput(['maxlength' => 2, 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($model, 'rw_wp')->textInput(['maxlength' => 2, 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) ?>
                </div>
            </div>    
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?php echo
                        $form->field($model, 'status_pekerjaan_wp')->widget(Select2::className(), [
                            'theme' => Select2::THEME_DEFAULT,
                            'data' => ArrayHelper::map($pekerjaanList, 'kode', 'nama'),
                            'pluginLoading' => false,
                            'options' => ['placeholder' => 'Pilih Pekerjaan'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumResultsForSearch' => 2
                            ],
                        ]);

                        // $form->field($model, 'status_pekerjaan_wp')->dropdownList(ArrayHelper::map($pekerjaanList, 'kode', 'nama'),['prompt' => "Pilih Pekerjaan"]
                        // );
                     ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'jalan_wp')->textInput(['maxlength' => true]) ?>
                </div>
            </div>    
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'telp_wp')->textInput(['maxlength' => true, 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'blok_kav_no_wp')->textInput(['maxlength' => true]) ?>
                </div>
            </div>    
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'handphone')->textInput(['maxlength' => true, 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'kd_pos_wp')->textInput(['maxlength' => true, 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) ?>
                </div>
            </div>    
        </div>

    </div>

    <hr />

    <div class="form-group">
        <div class="pull-left">

            <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-fw fa-save']) .' Save', ['class' => 'btn btn-success', 'id' => 'simpan', 'style' => 'display: none;']); ?>
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-arrow-left']) . ' Back', ['index'], ['class' => 'btn btn-default', 'id' => 'kembali', 'style' => 'display: none;']); ?>
            <?= Html::button(Html::tag('i', '', ['class' => 'fa fa-fw fa-pencil']) .' Update
            ', ['class' => 'btn btn-warning', 'id' => 'edit', 'style' => 'display: none;']); ?>
        
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
