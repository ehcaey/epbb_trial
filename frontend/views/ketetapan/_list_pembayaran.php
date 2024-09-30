<table class="table">
    <tr>
        <td width="30%"><strong>NOP</strong></td>
        <td width="2%">:</td>
        <td><?= $objekPajak->nop ?></td>
    </tr>
    <tr>
        <td><strong>NAMA WAJIB PAJAK</strong></td>
        <td>:</td>
        <td><?= $objekPajak->subjekPajak->nm_wp ?></td>
    </tr>
    <tr>
        <td><strong>ALAMAT OBJEK PAJAK</strong></td>
        <td>:</td>
        <td><?= $objekPajak->jalan_op ?></td>
    </tr>
    <tr>
        <td><strong>BLOK/KAV/NO OBJEK PAJAK</strong></td>
        <td>:</td>
        <td><?= $objekPajak->blok_kav_no_op ?></td>
    </tr>
    <tr>
        <td><strong>ALAMAT WAJIB PAJAK</strong></td>
        <td>:</td>
        <td><?= $objekPajak->subjekPajak->jalan_wp ?></td>
    </tr>
    <tr>
        <td><strong>BLOK/KAV/NO WAJIB PAJAK</strong></td>
        <td>:</td>
        <td><?= $objekPajak->subjekPajak->blok_kav_no_wp ?></td>
    </tr>
</table>

<hr>

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
        $totalBiayaAdmin = 0;

        foreach ($listSppt as $sppt) {
            $pajak = $sppt->pbb_yg_harus_dibayar_sppt;
            $denda = $sppt->denda;

            ?>
            <tr>
                <td>
                    <?= $sppt->thn_pajak_sppt ?>
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