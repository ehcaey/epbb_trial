<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SubjekPajak */

$this->title = 'Update Subjek Pajak: ' . $model->subjek_pajak_id;
$this->params['breadcrumbs'][] = ['label' => 'Subjek Pajaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subjek_pajak_id, 'url' => ['view', 'id' => $model->subjek_pajak_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subjek-pajak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
