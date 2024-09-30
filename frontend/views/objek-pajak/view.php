<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ObjekPajak */

$this->title = $model->kd_propinsi;
$this->params['breadcrumbs'][] = ['label' => 'Dat Objek Pajaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dat-objek-pajak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'kd_propinsi' => $model->kd_propinsi, 'kd_dati2' => $model->kd_dati2, 'kd_kecamatan' => $model->kd_kecamatan, 'kd_kelurahan' => $model->kd_kelurahan, 'kd_blok' => $model->kd_blok, 'no_urut' => $model->no_urut, 'kd_jns_op' => $model->kd_jns_op], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kd_propinsi' => $model->kd_propinsi, 'kd_dati2' => $model->kd_dati2, 'kd_kecamatan' => $model->kd_kecamatan, 'kd_kelurahan' => $model->kd_kelurahan, 'kd_blok' => $model->kd_blok, 'no_urut' => $model->no_urut, 'kd_jns_op' => $model->kd_jns_op], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kd_propinsi',
            'kd_dati2',
            'kd_kecamatan',
            'kd_kelurahan',
            'kd_blok',
            'no_urut',
            'kd_jns_op',
            'subjek_pajak_id',
            'no_formulir_spop',
            'no_persil',
            'jalan_op',
            'blok_kav_no_op',
            'rw_op',
            'rt_op',
            'kd_status_cabang',
            'kd_status_wp',
            'total_luas_bumi',
            'total_luas_bng',
            'njop_bumi',
            'njop_bng',
            'status_peta_op',
            'jns_transaksi_op',
            'tgl_pendataan_op',
            'nip_pendata',
            'tgl_pemeriksaan_op',
            'nip_pemeriksa_op',
            'tgl_perekaman_op',
            'nip_perekam_op',
            'createdby',
            'createdtime',
            'updatedby',
            'updatedtime',
        ],
    ]) ?>

</div>
