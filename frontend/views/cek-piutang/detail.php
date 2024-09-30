<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii2assets\pdfjs\PdfJs;

$nop;
$model;
$modelSp;
$modelSPPT;
$fileName;


/* @var $this \yii\web\View */
/* @var $content string */
dmstr\web\AdminLteAsset::register($this);
?>

<div class="subjek-pajak-create" style="margin:20px;">
    <div class="panel panel-default">
        <div class="panel-heading d-flex">
            <h3 class="panel-title">DATA WAJIB PAJAK</h3>
            <!-- <button class="btn btn-primary"><i class="fa fa-fw fa-print"></i></button> -->
            <!-- <?php
            echo Html::a(
                Html::tag('i', '', ['class' => 'fa fa-fw fa-print']),
                Url::to('/cek-piutang/print-wp?nop=' . $nop),
                ['class' => 'btn btn-primary', 'target' => '_blank']
            );
            ?> -->
        </div>
        <div class="panel-body">
            <div class="subjek-pajak-form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="tes">Nama</label>
                        <input type="text" id="nama" class="input-group input1" value="<?= $modelSp->nm_wp ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="nop">NOP</label>
                        <input type="text" placeholder="nop" id="nop" class="input-group input1"
                            value="<?= substr($nop, 0, 2) . '.' . substr($nop, 2, 2) . '.' . substr($nop, 4, 3) . '.' . substr($nop, 7, 3) . '.' . substr($nop, 10, 3) . '-' . substr($nop, 13, 4) . '.' . substr($nop, 17, 1) ?>"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="alamat">Alamat Wajib Pajak</label>
                        <input type="text" placeholder="alamat" id="alamat_wp" class="input-group input1"
                            value="<?= $modelSp->jalan_wp ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="tes">Alamat Objek Pajak</label>
                        <input type="text" placeholder="alamat_op" id="alamat_op" class="input-group input1"
                            value="<?= $model->jalan_op ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="subjek-pajak-create" style="margin:20px;">
    <div class="panel panel-default">
        <div class="panel-heading d-flex">
            <h3 class="panel-title">PBB</h3>
            <?php
                echo Html::a(
                    'Cetak Bukti Bayar',
                    Url::to(),
                    [
                        'id' => 'cetakBukti',
                        'class' => 'btn btn-primary',
                        'target' => '_blank',
                        'style' => 'display: none;'
                    ]
                );
            ?>
        </div>
        <div class="panel-body">
            <div class="subjek-pajak-form table-responsive">
                <table id="users-table" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Nama WP</th>
                            <th class="text-center">PBB</th>
                            <th class="text-center">Jatuh Tempo</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Tanggal Bayar</th>
                            <th class="text-center">Denda (saat ini)</th>
                            <th class="text-center">Pembayaran</th>
                            <!-- <th class="text-center">Bukti Bayar</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($modelSPPT as $key): ?>
                            <tr>
                                <td class="text-center"><?= $key['thn_pajak_sppt'] ?></td>
                                <td class="text-center"><?= $key['nm_wp_sppt'] ?></td>
                                <td class="text-center"><?= number_format($key['pbb_yg_harus_dibayar_sppt'], 0, ',', '.') ?>
                                </td>
                                <td class="text-center"><?= $key['tgl_jatuh_tempo_sppt'] ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($key['status_pembayaran_sppt'] == 1) {
                                        echo 'LUNAS';
                                    } elseif ($key['status_pembayaran_sppt'] == 0) {
                                        echo 'BELUM LUNAS';
                                    } else {
                                        echo 'DI BATALKAN';
                                    }
                                    ?>
                                </td>
                                <td class="text-center"><?= $key['tgl_pembayaran_sppt'] ?></td>
                                <td class="text-center">
                                    <?= $key['status_pembayaran_sppt'] == 0 ? number_format($key['denda'], 0, ',', '.') : '0' ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($key['status_pembayaran_sppt'] == 0): ?>
                                        <?= Html::checkbox('pbbCheckbox[]', false, [
                                            'value' => json_encode($key),
                                            'class' => 'pbb-checkbox',
                                            'data-year' => $key['thn_pajak_sppt']
                                        ]) ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <!-- <?php
                                    if ($key['status_pembayaran_sppt'] == 1) {
                                        echo Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-print']), Url::to('/cek-piutang/print-stts?nop=' . $nop . '&tahun=' . $key['thn_pajak_sppt']), ['class' => 'btn btn-primary', 'target' => '_blank']);
                                    }
                                    ?> -->

                                    <!-- <?php if ($key['status_pembayaran_sppt'] == 1): ?>
                                        <?= Html::checkbox('CheckboxBayar[]', false, [
                                            'value' => json_encode($key),
                                            'class' => 'checkbox-bayar',
                                            'data-year' => $key['thn_pajak_sppt']
                                        ]) ?>
                                    <?php endif; ?> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- QRIS Modal -->
            <div class="modal fade" id="qrisModal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="qrisModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="modal-title" id="qrisModalLabel">QRIS</h5>
                                </div>
                                <div class="col-xs-6">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-xs-5"><strong>Tahun Pajak</strong></div>
                                <div class="col-xs-1 no-padding text-center">:</div>
                                <div class="col-xs-6"><span id="modalTahun"></span></div>
                                <div class="col-xs-5"><strong>Total Bayar</strong></div>
                                <div class="col-xs-1 no-padding text-center">:</div>
                                <div class="col-xs-6"><span id="modalTotal"></span></div>
                            </div>

                            <div class="text-center" style="margin-top:15px;">
                                <img id="qrisImage" src="" alt="QRIS Image" class="img-fluid text-center">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <button class="btn btn-warning btn-sm" id="downloadButton">Download QRIS</button>
                                </div>
                                <div class="col-xs-6">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Alert -->
            <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#d9534f; color:#fff;">
                            <h5 class="modal-title" id="notificationModalLabel">WARNING !</h5>
                        </div>
                        <div class="modal-body text-center" id="modalMessage">
                            <!-- Pesan akan ditampilkan di sini -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="pull-right" style="margin-right: 20px;margin-top:10px;">
                    <label for="totalPBB" style="margin-right: 10px;">Total Bayar PBB</label>
                    <input type="text" class="total" id="totalPBB" value="0" style="text-align: right;" readonly>
                    <input type="hidden" class="tahun" id="tahun">
                    <input type="hidden" class="nop" id="nop" value="<?= $nop ?>">
                </div>
            </div>

            <div class="row">
                <div class="pull-right d-flex" style="margin-right: 20px;margin-top:10px;">
                    <button id="generateQrisButton" style="display:none;margin-right: 10px;" class="btn btn-danger">
                        Generate QRIS
                    </button>

                    <button id="generateVa" style="display:none;" class="btn btn-primary">
                        Generate VA
                    </button>
                </div>
            </div>
        </div>

        <!-- VA Modal -->
        <div class="modal fade" id="ModalVa" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="ModalVaLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="modal-title text-uppercase" id="ModalVaLabel">virtual account</h5>
                                </div>
                                <div class="col-xs-6">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="va">
                                <label for="tes">Nomor VA</label>
                                <input type="text" id="va" class="input-group input1" value="12346789" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm"data-dismiss="modal">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php
$getDataUrl = Url::to('@web/cek-piutang/search');
$url = Url::to(['cek-piutang/generate-va']);

$script = <<<JS
    $(document).ready(function() {
        console.log("DOM fully loaded and parsed");

        function updateTotalPBB() {
            let total = 0;
            let tahunPBBArray = [];

            $('.pbb-checkbox:checked').each(function() {
                var keyData = JSON.parse($(this).val());
                var pbb_yg_harus_dibayar_sppt = keyData['pbb_yg_harus_dibayar_sppt'];
                var denda = keyData['denda'];
                var tahun = keyData['thn_pajak_sppt'];
                // Menambahkan nilai dari pbb_yg_harus_dibayar_sppt dan denda ke total
                total += parseFloat(pbb_yg_harus_dibayar_sppt) + parseFloat(denda);
                tahunPBBArray.push(tahun);
            });

            console.log("Total PBB: ", total); // Debugging line
            $('#totalPBB').val(total.toLocaleString('id-ID'));

            console.log("tahun: ", tahunPBBArray); // Debugging line
            $('#tahun').val(tahunPBBArray.join(', '));

            // Tampilkan atau sembunyikan tombol Generate QRIS
            if (total > 0) {
                $('#generateQrisButton').show();
                $('#generateVa').show();
            } else {
                $('#generateQrisButton').hide();
                $('#generateVa').hide();
            }
        }

        $('.pbb-checkbox').on('change', function() {
            console.log('Checkbox changed:', $(this).val()); // Debugging line
            var checkedYear = $(this).data('year');
            // Cek apakah checkbox diubah menjadi checked atau unchecked
            var isChecked = $(this).is(':checked');

            if (isChecked) {
            // Centang dan kunci semua checkbox di bawah tahun yang dipilih
                $('.pbb-checkbox').each(function() {
                    var year = $(this).data('year');
                    if (year < checkedYear) {
                        $(this).prop('checked', true);
                        $(this).prop('disabled', true);
                    }
                });
            } else {
                // Jika checkbox pertama di-uncheck, buka kunci semua checkbox di bawah tahun yang dipilih
                $('.pbb-checkbox').each(function() {
                    var year = $(this).data('year');
                    if (year < checkedYear) {
                        $(this).prop('checked', false);
                        $(this).prop('disabled', false);
                    }
                });
            }

            updateTotalPBB();
        });

        function showModalNotif(message) {
                $('#modalMessage').text(message);
                $('#notificationModal').modal('show');
        }

        $('#generateVa').on('click', function() {
            var totalPBB = $('#totalPBB').val();
            var tahun = $('#tahun').val().split(', '); // Ubah kembali string menjadi array
            var nop = $('#nop').val();

            if (parseInt(totalPBB.replace(/\./g, ''), 10) > 9999999) {
                showModalNotif('Nominal terlalu besar untuk dibayar via VA!');
            } else {
                // $.ajax({
                //     url: '{$url}',
                //     type: 'POST',
                //     data: {
                //         totalPBB: totalPBB,
                //         tahun: tahun,
                //         nop: nop
                //     },
                //     success: function(data) {
                //         if (data.status === 'success') {
                //             // Lakukan sesuatu dengan response sukses
                //             // console.log('Data berhasil dikirim: ', data);
                //             $('#modalTotal').text(totalPBB);
                //             $('#modalTahun').text(Array.isArray(data.tahun) ? data.tahun.join(', ') : data.tahun);
                //             $('#qrisImage').attr('src', data.image);
                //             $('#qrisModal').modal('show');
                //         } else {
                //             // Lakukan sesuatu dengan response gagal
                //             console.log('Gagal mengirim data');
                //         }
                //     },
                //     error: function() {
                //         // Tangani kesalahan AJAX
                //         console.log('Error occurred');
                //         console.error('Error: ' + error);
                //         console.error('Status: ' + status);
                //         console.dir(xhr);
                //     }
                // });

                $('#modalTotal').text(totalPBB);
                $('#ModalVa').modal('show');
            }
        });

        $('#qrisModal').on('shown.bs.modal', function () {
            setTimeout(function() {
                $('#qrisModal').modal('hide');
            }, 7200000); // 2 jam
        });

        $("#downloadButton").click(function() {
                // Dapatkan elemen gambar QRIS
                const qrisImage = document.getElementById("qrisImage");
                // Ambil URL dari gambar QRIS
                const imageUrl = qrisImage.src;

                // Buat elemen link secara dinamis
                const link = document.createElement("a");
                // Set URL dari link ke URL gambar
                link.href = imageUrl;
                // Set atribut download untuk link dengan nama file yang diinginkan
                link.download = "QRIS_Image.png";

                // Tambahkan link ke dokumen agar bisa diklik
                document.body.appendChild(link);
                // Klik link secara otomatis untuk memulai unduhan
                link.click();
                // Hapus link dari dokumen setelah klik untuk membersihkan
                document.body.removeChild(link);
        });

        $('.checkbox-bayar').on('change', function() {
            // Perbarui array tahun berdasarkan checkbox yang dicentang
            getTahunBayar();
        });

        function getTahunBayar() {
            let tahunPBBArray = [];

            $('.checkbox-bayar').each(function() {
                var keyData = JSON.parse($(this).val());
                var tahun = keyData['thn_pajak_sppt'];
                
                if ($(this).is(':checked')) {
                    if (!tahunPBBArray.includes(tahun)) {
                        tahunPBBArray.push(tahun);
                    }
                } else {
                    var index = tahunPBBArray.indexOf(tahun);
                    if (index !== -1) {
                        tahunPBBArray.splice(index, 1);
                    }
                }
            });

            // Menggabungkan tahunPBBArray menjadi string dengan koma
            let tahunPBBString = tahunPBBArray.join(',');
            console.log('{$nop}'); // Debugging line

            // Memperbarui URL di elemen dengan ID 'printButton'
            $('#cetakBukti').attr('href', '/cek-piutang/print-stts-all?nop=' + '{$nop}' + '&tahun=' + tahunPBBString);

            console.log("tahun: ", tahunPBBString); // Debugging line

            // Tampilkan atau sembunyikan tombol cetak berdasarkan jumlah checkbox yang dicentang
            if (tahunPBBArray.length > 0) {
                $('#cetakBukti').show();
            } else {
                $('#cetakBukti').hide();
            }
        }

    });
JS;

$this->registerJs($script);
?>