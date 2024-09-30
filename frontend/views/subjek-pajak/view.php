<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SubjekPajak */

$this->title = $model->subjek_pajak_id;
$this->params['breadcrumbs'][] = ['label' => 'Subjek Pajaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subjek-pajak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->subjek_pajak_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->subjek_pajak_id], [
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
            'subjek_pajak_id',
            'nm_wp',
            'jalan_wp',
            'blok_kav_no_wp',
            'rw_wp',
            'rt_wp',
            'kelurahan_wp',
            'kota_wp',
            'kd_pos_wp',
            'telp_wp',
            'npwp',
            'status_pekerjaan_wp',
            'createdby',
            'createdtime',
            'updatedby',
            'updatedtime',
            'handphone',
        ],
    ]) ?>

</div>
