<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PstPermohonan */

$this->title = $model->thn_pelayanan;
$this->params['breadcrumbs'][] = ['label' => 'Pst Permohonans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pst-permohonan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'thn_pelayanan' => $model->thn_pelayanan, 'bundel_pelayanan' => $model->bundel_pelayanan, 'no_urut_pelayanan' => $model->no_urut_pelayanan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'thn_pelayanan' => $model->thn_pelayanan, 'bundel_pelayanan' => $model->bundel_pelayanan, 'no_urut_pelayanan' => $model->no_urut_pelayanan], [
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
            'kd_kanwil',
            'kd_kantor',
            'thn_pelayanan',
            'bundel_pelayanan',
            'no_urut_pelayanan',
            'no_srt_permohonan',
            'tgl_surat_permohonan',
            'nama_pemohon',
            'alamat_pemohon',
            'keterangan_pst',
            'catatan_pst',
            'status_kolektif',
            'tgl_terima_dokumen_wp',
            'tgl_perkiraan_selesai',
            'nip_penerima',
            'createdby',
            'createdtime',
            'updatedby',
            'updatedtime',
            'id_tujuan',
            'status',
            'status_hapus',
        ],
    ]) ?>

</div>
