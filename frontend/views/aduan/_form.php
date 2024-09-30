<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use marqu3s\summernote\Summernote;
use marqu3s\summernote\SummernoteAsset;
use marqu3s\summernote\SummernoteLanguageAsset;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Aduan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aduan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        
        <div class="col-lg-12">
            <h5 class="panel-section-title">Data User</h5>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($modelUser, 'email')->textInput(['maxlength' => true, 'disabled' => true])->label('Alamat Email') ?>
                </div>
            </div>    
        </div>

        <div class="col-lg-12">
            <h5 class="panel-section-title">Pengaduan</h5>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($model, 'subjek')->textInput(['maxlength' => true]) ?>
                </div>
            </div>    
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($modelBalasan, 'isi')->widget(Summernote::className(), [
                        'clientOptions' => [
                            'placeholder' => 'Pesan',
                            'minHeight' => 100,
                            'toolbar' => [
                                ['style', ['style']],
                                ['font', ['bold', 'italic', 'underline', 'clear']],
                                ['fontname', ['fontname']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video', 'hr']],
                                ['view', ['fullscreen', 'codeview']],
                                ['help', ['help']],
                            ]
                        ]
                    ])->label('Pesan'); ?>
                </div>
            </div>    
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <?php
            
                    echo $form->field($modelAttach, 'file_name')->widget(FileInput::className(), [
                        'pluginLoading' => false,
                        'pluginOptions' => [
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false
                        ],
                    ])->label('Lampiran');

                    ?>
                </div>
            </div>    
        </div>
    </div>

    <hr />

    <div class="form-group">
        <div class="pull-left">

            <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-fw fa-save']) .' Save', ['class' => 'btn btn-success', 'id' => 'simpan']); ?>
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-arrow-left']) . ' Back', ['index'], ['class' => 'btn btn-default', 'id' => 'kembali']); ?>
        
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
