<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pbb.dat_op_bangunan".
 *
 * @property string $kd_propinsi
 * @property string $kd_dati2
 * @property string $kd_kecamatan
 * @property string $kd_kelurahan
 * @property string $kd_blok
 * @property string $no_urut
 * @property string $kd_jns_op
 * @property int $no_bng
 * @property string|null $kd_jpb
 * @property string|null $no_formulir_lspop
 * @property string|null $thn_dibangun_bng
 * @property string|null $thn_renovasi_bng
 * @property int|null $luas_bng
 * @property int|null $jml_lantai_bng
 * @property string|null $kondisi_bng
 * @property string|null $jns_konstruksi_bng
 * @property string|null $jns_atap_bng
 * @property string|null $kd_dinding
 * @property string|null $kd_lantai
 * @property string|null $kd_langit_langit
 * @property int|null $nilai_sistem_bng
 * @property string|null $jns_transaksi_bng
 * @property string|null $tgl_pendataan_bng
 * @property string|null $nip_pendata_bng
 * @property string|null $tgl_pemeriksaan_bng
 * @property string|null $nip_pemeriksa_bng
 * @property string|null $tgl_perekaman_bng
 * @property string|null $nip_perekam_bng
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class OpBangunan extends \yii\db\ActiveRecord
{
    public $jumlah;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.dat_op_bangunan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'no_urut', 'kd_jns_op', 'no_bng'], 'required'],
            [['no_bng', 'luas_bng', 'jml_lantai_bng', 'nilai_sistem_bng', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['no_bng', 'luas_bng', 'jml_lantai_bng', 'nilai_sistem_bng', 'createdby', 'updatedby'], 'integer'],
            [['tgl_pendataan_bng', 'tgl_pemeriksaan_bng', 'tgl_perekaman_bng', 'createdtime', 'updatedtime'], 'safe'],
            [['kd_propinsi', 'kd_dati2', 'kd_jpb'], 'string', 'max' => 2],
            [['kd_kecamatan', 'kd_kelurahan', 'kd_blok'], 'string', 'max' => 3],
            [['no_urut', 'thn_dibangun_bng', 'thn_renovasi_bng'], 'string', 'max' => 4],
            [['kd_jns_op', 'kondisi_bng', 'jns_konstruksi_bng', 'jns_atap_bng', 'kd_dinding', 'kd_lantai', 'kd_langit_langit', 'jns_transaksi_bng'], 'string', 'max' => 1],
            [['no_formulir_lspop'], 'string', 'max' => 11],
            [['nip_pendata_bng', 'nip_pemeriksa_bng', 'nip_perekam_bng'], 'string', 'max' => 18],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_propinsi' => 'Kode Propinsi',
            'kd_dati2' => 'Kode Dati 2',
            'kd_kecamatan' => 'Kode Kecamatan',
            'kd_kelurahan' => 'Kode Kelurahan',
            'kd_blok' => 'Kode Blok',
            'no_urut' => 'No Urut',
            'kd_jns_op' => 'Kode Jenis Op',
            'no_bng' => 'No Bng',
            'kd_jpb' => 'Kode JPB',
            'no_formulir_lspop' => 'No Formulir Lspop',
            'thn_dibangun_bng' => 'Thn Dibangun Bng',
            'thn_renovasi_bng' => 'Thn Renovasi Bng',
            'luas_bng' => 'Luas Bng',
            'jml_lantai_bng' => 'Jml Lantai Bng',
            'kondisi_bng' => 'Kondisi Bng',
            'jns_konstruksi_bng' => 'Jenis Konstruksi Bng',
            'jns_atap_bng' => 'Jenis Atap Bng',
            'kd_dinding' => 'Kode Dinding',
            'kd_lantai' => 'Kode Lantai',
            'kd_langit_langit' => 'Kode Langit Langit',
            'nilai_sistem_bng' => 'Nilai Sistem Bng',
            'jns_transaksi_bng' => 'Jenis Transaksi Bng',
            'tgl_pendataan_bng' => 'Tgl Pendataan Bng',
            'nip_pendata_bng' => 'Nip Pendata Bng',
            'tgl_pemeriksaan_bng' => 'Tgl Pemeriksaan Bng',
            'nip_pemeriksa_bng' => 'Nip Pemeriksa Bng',
            'tgl_perekaman_bng' => 'Tgl Perekaman Bng',
            'nip_perekam_bng' => 'Nip Perekam Bng',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
            'jumlah' => 'Jumlah Bangunan',
        ];
    }
}
