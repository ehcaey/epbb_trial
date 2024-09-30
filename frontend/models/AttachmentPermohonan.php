<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "epbb.attachment_permohonan".
 *
 * @property int $id
 * @property string $thn_pelayanan
 * @property string $bundel_pelayanan
 * @property string $no_urut_pelayanan
 * @property string $jenis_lampiran
 * @property string $file_name
 * @property int|null $createdby
 * @property string|null $createdtime
 * @property int|null $updatedby
 * @property string|null $updatedtime
 */
class AttachmentPermohonan extends \yii\db\ActiveRecord
{
    public $l_permohonan;
    public $l_ktp_wp;
    public $l_sertifikat_tanah;
    public $l_sppt;
    public $l_imb;
    public $l_akte_jual_beli;
    public $l_sk_pensiun;
    public $l_sk_pengurangan;
    public $l_pbb_tetangga;
    public $l_pbb_induk;
    public $l_foto_lokasi;
    public $l_spmkp_pbb;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epbb.attachment_permohonan';
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
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thn_pelayanan', 'bundel_pelayanan', 'no_urut_pelayanan', 'jenis_lampiran', 'file_name'], 'required'],
            [['createdby', 'updatedby'], 'default', 'value' => null],
            [['createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['thn_pelayanan', 'bundel_pelayanan'], 'string', 'max' => 4],
            [['no_urut_pelayanan'], 'string', 'max' => 3],
            [['jenis_lampiran'], 'string', 'max' => 255],
            [['file_name', 'l_permohonan', 'l_ktp_wp', 'l_sertifikat_tanah', 'l_sppt', 'l_imb', 'l_akte_jual_beli', 'l_sk_pensiun', 'l_sk_pengurangan', 'l_pbb_tetangga', 'l_pbb_induk', 'l_foto_lokasi', 'l_spmkp_pbb'], 'file', 'extensions' => 'pdf, jpg, jpeg, zip', 'maxSize' => '8388608'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thn_pelayanan' => 'Tahun Pelayanan',
            'bundel_pelayanan' => 'Bundel Pelayanan',
            'no_urut_pelayanan' => 'No Urut Pelayanan',
            'jenis_lampiran' => 'Jenis Lampiran',
            'file_name' => 'Nama File',
            'createdby' => 'Created By',
            'createdtime' => 'Created Time',
            'updatedby' => 'Updated By',
            'updatedtime' => 'Updated Time',
            'l_permohonan' => 'Surat Permohonan',
            'l_ktp_wp' => 'Scan KTP/SIM',
            'l_sertifikat_tanah' => 'Scan Sertifikat/Bukti Kepemilikan',
            'l_sppt' => 'Scan SPPT Tahun Berjalan',
            'l_imb' => 'Scan IMB',
            'l_akte_jual_beli' => 'Scan Akta Jual Beli',
            'l_sk_pensiun' => 'SK Pensiun/Veteran',
            'l_sk_pengurangan' => 'SK Pengurangan',
            'l_pbb_tetangga' => 'PBB Tetangga Terdekat',
            'l_pbb_induk' => 'PBB Induk',
            'l_foto_lokasi' => 'Foto Lokasi',
            'l_spmkp_pbb' => 'Surat Keterangan Tidak Mampu',
        ];
    }
}
