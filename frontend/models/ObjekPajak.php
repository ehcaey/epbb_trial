<?php

namespace frontend\models;

use frontend\models\Referensi\Kecamatan;
use frontend\models\Referensi\Kelurahan;
use frontend\models\Referensi\StatusWajibPajak;
use Yii;

/**
 * This is the model class for table "pbb.dat_objek_pajak".
 *
 * @property string $kd_propinsi
 * @property string $kd_dati2
 * @property string $kd_kecamatan
 * @property string $kd_kelurahan
 * @property string $kd_blok
 * @property string $no_urut
 * @property string $kd_jns_op
 * @property string|null $subjek_pajak_id
 * @property string|null $no_formulir_spop
 * @property string|null $no_persil
 * @property string|null $jalan_op
 * @property string|null $blok_kav_no_op
 * @property string|null $rw_op
 * @property string|null $rt_op
 * @property int|null $kd_status_cabang
 * @property string|null $kd_status_wp
 * @property int|null $total_luas_bumi
 * @property int|null $total_luas_bng
 * @property int|null $njop_bumi
 * @property int|null $njop_bng
 * @property int|null $status_peta_op
 * @property string|null $jns_transaksi_op
 * @property string|null $tgl_pendataan_op
 * @property string|null $nip_pendata
 * @property string|null $tgl_pemeriksaan_op
 * @property string|null $nip_pemeriksa_op
 * @property string|null $tgl_perekaman_op
 * @property string|null $nip_perekam_op
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class ObjekPajak extends \yii\db\ActiveRecord
{
    public $nm_wp;
    public $jalan_wp;
    public $blok_kav_no_wp;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.dat_objek_pajak';
    }

    /**
     * {@inheritdoc}
     */
    public static function primaryKey()
    {
        return ['kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'no_urut', 'kd_jns_op'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'no_urut', 'kd_jns_op'], 'required'],
            [['kd_status_cabang', 'total_luas_bumi', 'total_luas_bng', 'njop_bumi', 'njop_bng', 'status_peta_op', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['kd_status_cabang', 'total_luas_bumi', 'total_luas_bng', 'njop_bumi', 'njop_bng', 'status_peta_op', 'createdby', 'updatedby'], 'integer'],
            [['tgl_pendataan_op', 'tgl_pemeriksaan_op', 'tgl_perekaman_op', 'createdtime', 'updatedtime'], 'safe'],
            [['epbb_user_id'], 'number'],
            [['kd_propinsi', 'kd_dati2', 'rw_op'], 'string', 'max' => 2],
            [['kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'rt_op'], 'string', 'max' => 3],
            [['no_urut'], 'string', 'max' => 4],
            [['kd_jns_op', 'kd_status_wp', 'jns_transaksi_op'], 'string', 'max' => 1],
            [['subjek_pajak_id'], 'string', 'max' => 30],
            [['no_formulir_spop'], 'string', 'max' => 11],
            [['no_persil'], 'string', 'max' => 5],
            [['jalan_op'], 'string', 'max' => 50],
            [['blok_kav_no_op'], 'string', 'max' => 15],
            [['nip_pendata', 'nip_pemeriksa_op', 'nip_perekam_op'], 'string', 'max' => 18],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_propinsi' => 'Kode Provinsi',
            'kd_dati2' => 'Kode Dati 2',
            'kd_kecamatan' => 'Kode Kecamatan',
            'kd_kelurahan' => 'Kode Kelurahan',
            'kd_blok' => 'Kode Blok',
            'no_urut' => 'No. Urut',
            'kd_jns_op' => 'Kode Jenis Objek Pajak',
            'subjek_pajak_id' => 'ID Subjek Pajak',
            'no_formulir_spop' => 'No. Formulir SPOP',
            'no_persil' => 'No. Persil',
            'jalan_op' => 'Jalan',
            'blok_kav_no_op' => 'Blok/Kav/No',
            'rw_op' => 'RW',
            'rt_op' => 'RT',
            'kd_status_cabang' => 'Kode Status Cabang',
            'kd_status_wp' => 'Kode Status WP',
            'total_luas_bumi' => 'Total Luas Bumi',
            'total_luas_bng' => 'Total Luas Bangunan',
            'njop_bumi' => 'NJOP Bumi',
            'njop_bng' => 'NJOP Bng',
            'status_peta_op' => 'Status Peta',
            'jns_transaksi_op' => 'Jenis Transaksi',
            'tgl_pendataan_op' => 'Tanggal Pendataan',
            'nip_pendata' => 'NIP Pendata',
            'tgl_pemeriksaan_op' => 'Tanggal Pemeriksaan',
            'nip_pemeriksa_op' => 'NIP Pemeriksa',
            'tgl_perekaman_op' => 'Tanggal Perekaman',
            'nip_perekam_op' => 'NIP Perekam',
            'createdby' => 'Created by',
            'createdtime' => 'Created time',
            'updatedby' => 'Updated by',
            'updatedtime' => 'Updated time',
            'epbb_user_id' => 'User ID E-PBB'
        ];
    }

    public function getSubjekPajak()
    {
        return $this->hasOne(SubjekPajak::class, ['subjek_pajak_id' => 'subjek_pajak_id']);
    }

    public function getBangunan()
    {
        return $this->hasMany(OpBangunan::class, ['kd_propinsi' => 'kd_propinsi', 'kd_dati2' => 'kd_dati2', 'kd_kecamatan' => 'kd_kecamatan', 'kd_kelurahan' => 'kd_kelurahan', 'kd_blok' => 'kd_blok', 'no_urut' => 'no_urut', 'kd_jns_op' => 'kd_jns_op']);
    }

    public function getBumi()
    {
        return $this->hasOne(OpBumi::class, ['kd_propinsi' => 'kd_propinsi', 'kd_dati2' => 'kd_dati2', 'kd_kecamatan' => 'kd_kecamatan', 'kd_kelurahan' => 'kd_kelurahan', 'kd_blok' => 'kd_blok', 'no_urut' => 'no_urut', 'kd_jns_op' => 'kd_jns_op']);
    }

    public function getStatusWajibPajak()
    {
        return $this->hasOne(StatusWajibPajak::class, ['kode' => 'kd_status_wp']);
    }

    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::class, ['kd_propinsi' => 'kd_propinsi', 'kd_dati2' => 'kd_dati2', 'kd_kecamatan' => 'kd_kecamatan']);
    }

    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::class, ['kd_propinsi' => 'kd_propinsi', 'kd_dati2' => 'kd_dati2', 'kd_kecamatan' => 'kd_kecamatan', 'kd_kelurahan' => 'kd_kelurahan']);
    }

    public function getSppt()
    {
        return $this->hasMany(Sppt::class, ['kd_propinsi' => 'kd_propinsi', 'kd_dati2' => 'kd_dati2', 'kd_kecamatan' => 'kd_kecamatan', 'kd_kelurahan' => 'kd_kelurahan', 'kd_blok' => 'kd_blok', 'no_urut' => 'no_urut', 'kd_jns_op' => 'kd_jns_op']);
    }

    public function getNop()
    {
        return $this->kd_propinsi . $this->kd_dati2 . $this->kd_kecamatan . $this->kd_kelurahan . $this->kd_blok . $this->no_urut . $this->kd_jns_op;
    }

    public static function findByNop($nop)
    {
        return static::find()->where([
            'kd_propinsi' => substr($nop, 0, 2), 
            'kd_dati2' => substr($nop, 2, 2), 
            'kd_kecamatan' => substr($nop, 4, 3), 
            'kd_kelurahan' => substr($nop, 7, 3), 
            'kd_blok' => substr($nop, 10, 3), 
            'no_urut' => substr($nop, 13, 4), 
            'kd_jns_op' => substr($nop, 17, 1)
        ]);
    }
}
