<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelObjekPajak frontend\models\ObjekPajak */
/* @var $modelSubjekPajak frontend\models\SubjekPajak */

$this->title = 'Input Permohonan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="input-permohonan">
	<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        
        <div class="panel-body">
            <?= 
            
            $this->render('_form', compact(
                'modelPermohonan',
                'modelPermohonanDetail',
                'modelPermohonanLampiran',
                'modelPermohonanPengurangan',
                'modelAttachmentPermohonan',
                'modelDataObjekPajakBaru',
                'statusKolektifList',
                'jenisPelayananList',
                'jenisPenguranganList',
            ));

            ?>
        </div>
    </div>

</div>
