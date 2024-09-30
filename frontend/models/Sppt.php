<?php

namespace frontend\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "pbb.sppt".
 *
 * @property string $kd_propinsi
 * @property string $kd_dati2
 * @property string $kd_kecamatan
 * @property string $kd_kelurahan
 * @property string $kd_blok
 * @property string $no_urut
 * @property string $kd_jns_op
 * @property string $thn_pajak_sppt
 * @property int|null $siklus_sppt
 * @property string|null $kd_kanwil
 * @property string|null $kd_kantor
 * @property string|null $kd_tp
 * @property string|null $nm_wp_sppt
 * @property string|null $jln_wp_sppt
 * @property string|null $blok_kav_no_wp_sppt
 * @property string|null $rw_wp_sppt
 * @property string|null $rt_wp_sppt
 * @property string|null $kelurahan_wp_sppt
 * @property string|null $kota_wp_sppt
 * @property string|null $kd_pos_wp_sppt
 * @property string|null $npwp_sppt
 * @property string|null $no_persil_sppt
 * @property string|null $kd_kls_tanah
 * @property string|null $thn_awal_kls_tanah
 * @property string|null $kd_kls_bng
 * @property string|null $thn_awal_kls_bng
 * @property string|null $tgl_jatuh_tempo_sppt
 * @property int|null $luas_bumi_sppt
 * @property int|null $luas_bng_sppt
 * @property int|null $njop_bumi_sppt
 * @property int|null $njop_bng_sppt
 * @property int|null $njop_sppt
 * @property int|null $njoptkp_sppt
 * @property int|null $pbb_terhutang_sppt
 * @property int|null $faktor_pengurang_sppt
 * @property int|null $pbb_yg_harus_dibayar_sppt
 * @property string|null $status_pembayaran_sppt
 * @property string|null $status_tagihan_sppt
 * @property string|null $status_cetak_sppt
 * @property string|null $tgl_terbit_sppt
 * @property string|null $tgl_cetak_sppt
 * @property string|null $nip_pencetak_sppt
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class Sppt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.sppt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'no_urut', 'kd_jns_op', 'thn_pajak_sppt'], 'required'],
            [['siklus_sppt', 'luas_bumi_sppt', 'luas_bng_sppt', 'njop_bumi_sppt', 'njop_bng_sppt', 'njop_sppt', 'njoptkp_sppt', 'pbb_terhutang_sppt', 'faktor_pengurang_sppt', 'pbb_yg_harus_dibayar_sppt', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['siklus_sppt', 'luas_bumi_sppt', 'luas_bng_sppt', 'njop_bumi_sppt', 'njop_bng_sppt', 'njop_sppt', 'njoptkp_sppt', 'pbb_terhutang_sppt', 'faktor_pengurang_sppt', 'pbb_yg_harus_dibayar_sppt', 'createdby', 'updatedby'], 'integer'],
            [['tgl_jatuh_tempo_sppt', 'tgl_terbit_sppt', 'tgl_cetak_sppt', 'createdtime', 'updatedtime'], 'safe'],
            [['kd_propinsi', 'kd_dati2', 'kd_kanwil', 'kd_kantor', 'kd_tp', 'rw_wp_sppt'], 'string', 'max' => 2],
            [['kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'rt_wp_sppt', 'kd_kls_tanah', 'kd_kls_bng'], 'string', 'max' => 3],
            [['no_urut', 'thn_pajak_sppt', 'thn_awal_kls_tanah', 'thn_awal_kls_bng'], 'string', 'max' => 4],
            [['kd_jns_op', 'status_pembayaran_sppt', 'status_tagihan_sppt', 'status_cetak_sppt'], 'string', 'max' => 1],
            [['nm_wp_sppt', 'jln_wp_sppt', 'kelurahan_wp_sppt', 'kota_wp_sppt'], 'string', 'max' => 30],
            [['blok_kav_no_wp_sppt', 'npwp_sppt'], 'string', 'max' => 15],
            [['kd_pos_wp_sppt', 'no_persil_sppt'], 'string', 'max' => 5],
            [['nip_pencetak_sppt'], 'string', 'max' => 18],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_propinsi' => 'Kd Propinsi',
            'kd_dati2' => 'Kd Dati2',
            'kd_kecamatan' => 'Kd Kecamatan',
            'kd_kelurahan' => 'Kd Kelurahan',
            'kd_blok' => 'Kd Blok',
            'no_urut' => 'No Urut',
            'kd_jns_op' => 'Kd Jns Op',
            'thn_pajak_sppt' => 'Thn Pajak Sppt',
            'siklus_sppt' => 'Siklus Sppt',
            'kd_kanwil' => 'Kd Kanwil',
            'kd_kantor' => 'Kd Kantor',
            'kd_tp' => 'Kd Tp',
            'nm_wp_sppt' => 'Nm Wp Sppt',
            'jln_wp_sppt' => 'Jln Wp Sppt',
            'blok_kav_no_wp_sppt' => 'Blok Kav No Wp Sppt',
            'rw_wp_sppt' => 'Rw Wp Sppt',
            'rt_wp_sppt' => 'Rt Wp Sppt',
            'kelurahan_wp_sppt' => 'Kelurahan Wp Sppt',
            'kota_wp_sppt' => 'Kota Wp Sppt',
            'kd_pos_wp_sppt' => 'Kd Pos Wp Sppt',
            'npwp_sppt' => 'Npwp Sppt',
            'no_persil_sppt' => 'No Persil Sppt',
            'kd_kls_tanah' => 'Kd Kls Tanah',
            'thn_awal_kls_tanah' => 'Thn Awal Kls Tanah',
            'kd_kls_bng' => 'Kd Kls Bng',
            'thn_awal_kls_bng' => 'Thn Awal Kls Bng',
            'tgl_jatuh_tempo_sppt' => 'Tgl Jatuh Tempo Sppt',
            'luas_bumi_sppt' => 'Luas Bumi Sppt',
            'luas_bng_sppt' => 'Luas Bng Sppt',
            'njop_bumi_sppt' => 'Njop Bumi Sppt',
            'njop_bng_sppt' => 'Njop Bng Sppt',
            'njop_sppt' => 'Njop Sppt',
            'njoptkp_sppt' => 'Njoptkp Sppt',
            'pbb_terhutang_sppt' => 'Pbb Terhutang Sppt',
            'faktor_pengurang_sppt' => 'Faktor Pengurang Sppt',
            'pbb_yg_harus_dibayar_sppt' => 'Pbb Yg Harus Dibayar Sppt',
            'status_pembayaran_sppt' => 'Status Pembayaran Sppt',
            'status_tagihan_sppt' => 'Status Tagihan Sppt',
            'status_cetak_sppt' => 'Status Cetak Sppt',
            'tgl_terbit_sppt' => 'Tgl Terbit Sppt',
            'tgl_cetak_sppt' => 'Tgl Cetak Sppt',
            'nip_pencetak_sppt' => 'Nip Pencetak Sppt',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }

    public function getPembayaran()
    {
        return $this->hasOne(PembayaranSppt::class, ['kd_propinsi' => 'kd_propinsi', 'kd_dati2' => 'kd_dati2', 'kd_kecamatan' => 'kd_kecamatan', 'kd_kelurahan' => 'kd_kelurahan', 'kd_blok' => 'kd_blok', 'no_urut' => 'no_urut', 'kd_jns_op' => 'kd_jns_op', 'thn_pajak_sppt' => 'thn_pajak_sppt']);
    }

    public function getDenda()
    {
        $now = Carbon::now()->startOfDay();
        $tanggalJatuhTempo = Carbon::createFromFormat('Y-m-d H:i:s', $this->tgl_jatuh_tempo_sppt);

        if ($tanggalJatuhTempo > $now || ($now->format('Y-m-d') <= '2023-05-31' && $now->format('Y-m-d') >= '2023-05-02')) {
            return 0;
        }

        $bulan = ((int) $now->format('Y') - (int) $tanggalJatuhTempo->format('Y')) * 12;
        $bulan = $bulan - (int) $tanggalJatuhTempo->format('m');
        $hariTempo = (int) $tanggalJatuhTempo->format('d'); 
        $bulan = $bulan + (int) $now->format('m');
        $hariSekarang = (int) $now->format('d'); 

        if ($tanggalJatuhTempo->format('Y-m-d') < $now->format('Y-m-d')) {
            if ($hariSekarang > $hariTempo) { 
                $bulan++;
            }
        }

        if ($bulan > 24) {
            $bulan = 24;
        }

        return round($bulan * 0.02 * $this->pbb_yg_harus_dibayar_sppt);
    }
}
