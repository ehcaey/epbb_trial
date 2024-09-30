<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pbb.pst_lampiran".
 *
 * @property string $kd_kanwil
 * @property string $kd_kantor
 * @property string $thn_pelayanan
 * @property string $bundel_pelayanan
 * @property string $no_urut_pelayanan
 * @property int|null $l_permohonan
 * @property int|null $l_surat_kuasa
 * @property int|null $l_ktp_wp
 * @property int|null $l_sertifikat_tanah
 * @property int|null $l_sppt
 * @property int|null $l_imb
 * @property int|null $l_akte_jual_beli
 * @property int|null $l_sk_pensiun
 * @property int|null $l_sppt_stts
 * @property int|null $l_stts
 * @property int|null $l_sk_pengurangan
 * @property int|null $l_sk_keberatan
 * @property int|null $l_skkp_pbb
 * @property int|null $l_spmkp_pbb
 * @property int|null $l_lain_lain
 * @property int|null $l_sket_tanah
 * @property int|null $l_sket_lurah
 * @property int|null $l_npwpd
 * @property int|null $l_penghasilan
 * @property int|null $l_cagar
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class PstLampiran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.pst_lampiran';
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
            [['kd_kanwil', 'kd_kantor', 'thn_pelayanan', 'bundel_pelayanan', 'no_urut_pelayanan'], 'required'],
            [['l_permohonan', 'l_surat_kuasa', 'l_ktp_wp', 'l_sertifikat_tanah', 'l_sppt', 'l_imb', 'l_akte_jual_beli', 'l_sk_pensiun', 'l_sppt_stts', 'l_stts', 'l_sk_pengurangan', 'l_sk_keberatan', 'l_skkp_pbb', 'l_spmkp_pbb', 'l_lain_lain', 'l_sket_tanah', 'l_sket_lurah', 'l_npwpd', 'l_penghasilan', 'l_cagar', 'createdby', 'updatedby'], 'default', 'value' => 0],
            [['l_permohonan', 'l_surat_kuasa', 'l_ktp_wp', 'l_sertifikat_tanah', 'l_sppt', 'l_imb', 'l_akte_jual_beli', 'l_sk_pensiun', 'l_sppt_stts', 'l_stts', 'l_sk_pengurangan', 'l_sk_keberatan', 'l_skkp_pbb', 'l_spmkp_pbb', 'l_lain_lain', 'l_sket_tanah', 'l_sket_lurah', 'l_npwpd', 'l_penghasilan', 'l_cagar', 'createdby', 'updatedby', 'l_pbb_tetangga', 'l_pbb_induk', 'l_foto_lokasi'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['kd_kanwil', 'kd_kantor'], 'string', 'max' => 2],
            [['thn_pelayanan', 'bundel_pelayanan'], 'string', 'max' => 4],
            [['no_urut_pelayanan'], 'string', 'max' => 3],
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
            'thn_pelayanan' => 'Thn Pelayanan',
            'bundel_pelayanan' => 'Bundel Pelayanan',
            'no_urut_pelayanan' => 'No Urut Pelayanan',
            'l_permohonan' => 'L Permohonan',
            'l_surat_kuasa' => 'L Surat Kuasa',
            'l_ktp_wp' => 'L Ktp Wp',
            'l_sertifikat_tanah' => 'L Sertifikat Tanah',
            'l_sppt' => 'L Sppt',
            'l_imb' => 'L Imb',
            'l_akte_jual_beli' => 'L Akte Jual Beli',
            'l_sk_pensiun' => 'L Sk Pensiun',
            'l_sppt_stts' => 'L Sppt Stts',
            'l_stts' => 'L Stts',
            'l_sk_pengurangan' => 'L Sk Pengurangan',
            'l_sk_keberatan' => 'L Sk Keberatan',
            'l_skkp_pbb' => 'L Skkp Pbb',
            'l_spmkp_pbb' => 'L Spmkp Pbb',
            'l_lain_lain' => 'L Lain Lain',
            'l_sket_tanah' => 'L Sket Tanah',
            'l_sket_lurah' => 'L Sket Lurah',
            'l_npwpd' => 'L Npwpd',
            'l_penghasilan' => 'L Penghasilan',
            'l_cagar' => 'L Cagar',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
            'l_pbb_tetangga' => 'Lampiran PBB Tetangga', 
            'l_pbb_induk' => 'Lampiran PBB Induk', 
            'l_foto_lokasi' => 'Lampiran Foto Lokasi',
        ];
    }
}
