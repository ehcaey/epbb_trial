<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ObjekPajak */

$this->title = 'Update Dat Objek Pajak: ' . $model->kd_propinsi;
$this->params['breadcrumbs'][] = ['label' => 'Dat Objek Pajaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kd_propinsi, 'url' => ['view', 'kd_propinsi' => $model->kd_propinsi, 'kd_dati2' => $model->kd_dati2, 'kd_kecamatan' => $model->kd_kecamatan, 'kd_kelurahan' => $model->kd_kelurahan, 'kd_blok' => $model->kd_blok, 'no_urut' => $model->no_urut, 'kd_jns_op' => $model->kd_jns_op]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dat-objek-pajak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
