<?php

namespace frontend\models;

use frontend\models\Referensi\JenisPelayanan;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pbb.pst_permohonan".
 *
 * @property string $kd_kanwil
 * @property string $kd_kantor
 * @property string $thn_pelayanan
 * @property string $bundel_pelayanan
 * @property string $no_urut_pelayanan
 * @property string|null $no_srt_permohonan
 * @property string|null $tgl_surat_permohonan
 * @property string|null $nama_pemohon
 * @property string|null $alamat_pemohon
 * @property string|null $keterangan_pst
 * @property string|null $catatan_pst
 * @property string|null $status_kolektif
 * @property string|null $tgl_terima_dokumen_wp
 * @property string|null $tgl_perkiraan_selesai
 * @property string|null $nip_penerima
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 * @property int|null $id_tujuan
 * @property int|null $status
 * @property int|null $status_hapus
 */
class PstPermohonan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.pst_permohonan';
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
    public static function primaryKey()
    {
        return ['thn_pelayanan', 'bundel_pelayanan', 'no_urut_pelayanan'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_kanwil', 'kd_kantor'], 'required'],
            [['tgl_surat_permohonan', 'tgl_terima_dokumen_wp', 'tgl_perkiraan_selesai', 'createdtime', 'updatedtime'], 'safe'],
            [['createdby', 'updatedby', 'id_tujuan', 'status', 'status_hapus'], 'default', 'value' => null],
            [['createdby', 'updatedby', 'id_tujuan', 'status', 'status_hapus'], 'integer'],
            [['kd_kanwil', 'kd_kantor'], 'string', 'max' => 2],
            [['thn_pelayanan', 'bundel_pelayanan'], 'string', 'max' => 4],
            [['no_urut_pelayanan'], 'string', 'max' => 3],
            [['no_srt_permohonan', 'nama_pemohon'], 'string', 'max' => 30],
            [['alamat_pemohon'], 'string', 'max' => 40],
            [['keterangan_pst', 'catatan_pst'], 'string', 'max' => 75],
            [['status_kolektif'], 'string', 'max' => 1],
            [['nip_penerima'], 'string', 'max' => 18],
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
            'no_srt_permohonan' => 'No Surat Permohonan',
            'tgl_surat_permohonan' => 'Tanggal Surat Permohonan',
            'nama_pemohon' => 'Nama Pemohon',
            'alamat_pemohon' => 'Alamat Pemohon',
            'keterangan_pst' => 'Keterangan',
            'catatan_pst' => 'Catatan Pst',
            'status_kolektif' => 'Status Kolektif',
            'tgl_terima_dokumen_wp' => 'Tanggal Terima Dokumen WP',
            'tgl_perkiraan_selesai' => 'Tanggal Perkiraan Selesai',
            'nip_penerima' => 'NIP Penerima',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
            'id_tujuan' => 'Id Tujuan',
            'status' => 'Status',
            'status_hapus' => 'Status Hapus',
        ];
    }

    public function getDetail()
    {
        return $this->hasOne(PstDetail::class, ['thn_pelayanan' => 'thn_pelayanan', 'bundel_pelayanan' => 'bundel_pelayanan', 'no_urut_pelayanan' => 'no_urut_pelayanan']);
    }
}
