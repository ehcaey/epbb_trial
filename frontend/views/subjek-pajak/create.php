<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SubjekPajak */

$this->title = 'Identitas Wajib Pajak';
$this->params['breadcrumbs'][] = ['label' => 'Data Wajib Pajak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjek-pajak-create">
	<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', compact('model', 'pekerjaanList')); ?>
        </div>
    </div>
</div>
