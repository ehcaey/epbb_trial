<?php

namespace frontend\models;

use frontend\models\Referensi\JenisPelayanan;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pbb.pst_detail".
 *
 * @property string $kd_kanwil
 * @property string $kd_kantor
 * @property string $thn_pelayanan
 * @property string $bundel_pelayanan
 * @property string $no_urut_pelayanan
 * @property string $kd_propinsi_pemohon
 * @property string $kd_dati2_pemohon
 * @property string $kd_kecamatan_pemohon
 * @property string $kd_kelurahan_pemohon
 * @property string $kd_blok_pemohon
 * @property string $no_urut_pemohon
 * @property string $kd_jns_op_pemohon
 * @property string $kd_jns_pelayanan
 * @property string $thn_pajak_permohonan
 * @property string|null $nama_penerima
 * @property string|null $catatan_penyerahan
 * @property int|null $status_selesai
 * @property string|null $tgl_selesai
 * @property string|null $kd_seksi_berkas
 * @property string|null $tgl_penyerahan
 * @property string|null $nip_penyerah
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class PstDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.pst_detail';
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdtime',
                'updatedAtAttribute' => 'updatedtime',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'createdby',
                'updatedByAttribute' => 'updatedby',
                'value' => -1,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_kanwil', 'kd_kantor', 'thn_pelayanan', 'bundel_pelayanan', 'no_urut_pelayanan', 'kd_propinsi_pemohon', 'kd_dati2_pemohon', 'kd_kecamatan_pemohon', 'kd_kelurahan_pemohon', 'kd_blok_pemohon', 'no_urut_pemohon', 'kd_jns_op_pemohon', 'kd_jns_pelayanan', 'thn_pajak_permohonan'], 'required'],
            [['status_selesai', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['status_selesai', 'createdby', 'updatedby'], 'integer'],
            [['tgl_selesai', 'tgl_penyerahan', 'createdtime', 'updatedtime'], 'safe'],
            [['kd_kanwil', 'kd_kantor', 'kd_propinsi_pemohon', 'kd_dati2_pemohon', 'kd_jns_pelayanan', 'kd_seksi_berkas'], 'string', 'max' => 2],
            [['thn_pelayanan', 'bundel_pelayanan', 'no_urut_pemohon', 'thn_pajak_permohonan'], 'string', 'max' => 4],
            [['no_urut_pelayanan', 'kd_kecamatan_pemohon', 'kd_kelurahan_pemohon', 'kd_blok_pemohon'], 'string', 'max' => 3],
            [['kd_jns_op_pemohon'], 'string', 'max' => 1],
            [['nama_penerima'], 'string', 'max' => 30],
            [['catatan_penyerahan'], 'string', 'max' => 75],
            [['nip_penyerah'], 'string', 'max' => 18],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_kanwil' => 'Kd Kanwil',
            'kd_kantor' => 'Kd Kantor',
            'thn_pelayanan' => 'Tahun Pelayanan',
            'bundel_pelayanan' => 'Bundel Pelayanan',
            'no_urut_pelayanan' => 'No Urut Pelayanan',
            'kd_propinsi_pemohon' => 'Kode Propinsi',
            'kd_dati2_pemohon' => 'Kode Dati 2',
            'kd_kecamatan_pemohon' => 'Kode Kecamatan',
            'kd_kelurahan_pemohon' => 'Kode Kelurahan',
            'kd_blok_pemohon' => 'Kode Blok',
            'no_urut_pemohon' => 'No Urut',
            'kd_jns_op_pemohon' => 'Kode Jenis Objek Pajak',
            'kd_jns_pelayanan' => 'Kode Jenis Pelayanan',
            'thn_pajak_permohonan' => 'Tahun Pajak Permohonan',
            'nama_penerima' => 'Nama Penerima',
            'catatan_penyerahan' => 'Catatan Penyerahan',
            'status_selesai' => 'Status Selesai',
            'tgl_selesai' => 'Tanggal Selesai',
            'kd_seksi_berkas' => 'Kode Seksi Berkas',
            'tgl_penyerahan' => 'Tanggal Penyerahan',
            'nip_penyerah' => 'NIP Penyerah',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }

    public function getJenisPelayanan()
    {
        return $this->hasOne(JenisPelayanan::class, ['kd_jns_pelayanan' => 'kd_jns_pelayanan']);
    }
}
