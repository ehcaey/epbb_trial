<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use marqu3s\summernote\Summernote;
use marqu3s\summernote\SummernoteAsset;
use marqu3s\summernote\SummernoteLanguageAsset;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Aduan */
/* @var $form yii\widgets\ActiveForm */
?>
<?php if($model->status == '1'){ ?>
<div class="panel panel-default">
	<div class="panel-heading">
	    <h3 class="panel-title pull-left"><span class="fa fa-fw fa-pencil"></span> Balasan</h3>
	    <h3 class="panel-title pull-right"><a data-toggle="collapse" href="#form-input" role="button" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-fw fa-plus"></span></a></h3>
	    <div class="clearfix"></div>
	</div>
	<div class="panel-body collapse" id="form-input">
		
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
		                    <?= $form->field($model, 'subjek')->textInput(['maxlength' => true, 'readonly' => true]) ?>
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


	</div>
</div>
<?php } ?>




<?php

foreach ($dataBalasan as $data) {
?>
	<div class="panel panel-default">
		<div class="panel-heading">
	        <h3 class="panel-title pull-left"><span class="fa fa-fw fa-user"></span><?= ($data['tipe_user'] == '1') ? $data['nama'] : "Operator"; ?></h3>
	        <h3 class="panel-title pull-right"><?= date_format(date_create($data['createdtime']), 'd-m-Y H:i:s'); ?></h3>
	        <div class="clearfix"></div>
	    </div>
	    <div class="panel-body">
	    	<?= $data['isi']; ?>
	    	<?php
	    		if($data['id_attach'] != null){
	    	?>
	    	<hr>
	    	<a href="<?= Yii::$app->uploadUrlManager->createUrl('/'. $data['file_name']); ?>" target="_blank"><button class="btn btn-primary btn-sm"><span class="fa fa-fw fa-download"></span> <?= $data['file_name']; ?></button></a>
	    	<?php
	    	}
	    	?>
	    </div>
	</div>
<?php
}

?>