<?php

use Carbon\Carbon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\VirtualAccount */

$this->title = 'Detail';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model->no_va;

?>
<div class="virtual-account-view">
    <div class="panel panel-default">
        <div class="panel-heading">    
            <h3 class="panel-title"><?= $this->title ?></h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <td width="30%"><strong>No. Virtual Account</strong></td>
                    <td width="2%">:</td>
                    <td><?= $model->no_va ?></td>
                </tr>
                <tr>
                    <td><strong>NOP</strong></td>
                    <td>:</td>
                    <td><?= $model->nop ?></td>
                </tr>
                <tr>
                    <td><strong>Alamat Objek Pajak</strong></td>
                    <td>:</td>
                    <td><?= $model->alamat_op ?></td>
                </tr>
                <tr>
                    <td><strong>Kota</strong></td>
                    <td>:</td>
                    <td><?= $model->kota_op ?></td>
                </tr>
                <tr>
                    <td><strong>Status Pembayaran</strong></td>
                    <td>:</td>
                    <td><?= ($model->status_pembayaran == '1') ? '<span class="text-success">Lunas (' . Carbon::createFromFormat('Y-m-d H:i:s', $model->tgl_pembayaran)->format('d/m/Y') . ')</span>': 'Belum Lunas' ?></td>
                </tr>
            </table>

            <hr style="margin-top: 15px;margin-bottom: 15px;">

            <div class="row">
                <div class="col-lg-12">
                    <h5 class="panel-section-title">Detail</h5>
                </div>
            </div>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tahun Pajak</th>
                        <th>Jumlah Pajak (Rp.)</th>
                        <th>Denda (Rp.)</th>
                        <th>Total (Rp.)</th>
                    </tr>
                </thead>
                    
                <tbody>
                    <?php 
                    $totalPajak = 0;
                    $totalDenda = 0;

                    foreach ($model->details as $detail) {
                        $pajak = $detail->jumlah_pajak;
                        $denda = $detail->denda_pajak;

                        ?>
                        <tr>
                            <td>
                                <?= $detail->tahun_pajak ?>
                            </td>
                            <td class="text-right">
                                <?= number_format($pajak, 0, ',', '.') ?>
                            </td>
                            <td class="text-right">
                                <?= number_format($denda, 0, ',', '.') ?>
                            </td>
                            <td class="text-right">
                                <?= number_format($pajak + $denda, 0, ',', '.') ?>
                            </td>
                        </tr>
                        <?php

                        $totalPajak += $pajak;
                        $totalDenda += $denda;
                    }
                    ?>
                </tbody>
            </table>

            <table class="table" style="margin-top: 15px;">
                <tr class="active">
                    <td width="40%"><strong>Biaya Admin (Rp.)</strong></td>
                    <td width="2%">:</td>
                    <td class="text-right"><strong><?= number_format(Yii::$app->params['fee_ws'], 0, ',', '.') ?></strong></td>
                </tr>
                <tr class="success">
                    <td width="40%"><strong>Total Pajak yang Harus Dibayar (Rp.)</strong></td>
                    <td width="2%">:</td>
                    <td class="text-right"><strong><?= number_format($totalPajak + $totalDenda + Yii::$app->params['fee_ws'], 0, ',', '.') ?></strong></td>
                </tr>
            </table>
            
            <hr>
            
            <div class="form-group" style="margin-top: 20px;">
                <div class="pull-left">
                    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-arrow-left']) . ' Kembali', ['index'], ['class' => 'btn btn-default']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
