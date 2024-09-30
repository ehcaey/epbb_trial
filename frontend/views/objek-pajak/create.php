<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelObjekPajak frontend\models\ObjekPajak */
/* @var $modelSubjekPajak frontend\models\SubjekPajak */

$this->title = 'Tambah Objek Pajak';
$this->params['breadcrumbs'][] = ['label' => 'Data Objek Pajak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tambah-objek-pajak">
	<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        
        <div class="panel-body">
            <?= $this->render('_form', compact('modelJenisTanah', 'modelKelurahan', 'modelObjekPajak', 'modelOpBangunan', 'modelOpBumi', 'modelSubjekPajak')) ?>
        </div>
    </div>

</div>
