<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pbb.pst_permohonan_pengurangan".
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
 * @property string|null $jns_pengurangan
 * @property float|null $pct_permohonan_pengurangan
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class PstPermohonanPengurangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.pst_permohonan_pengurangan';
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
            [['kd_kanwil', 'kd_kantor', 'thn_pelayanan', 'bundel_pelayanan', 'no_urut_pelayanan', 'kd_propinsi_pemohon', 'kd_dati2_pemohon', 'kd_kecamatan_pemohon', 'kd_kelurahan_pemohon', 'kd_blok_pemohon', 'no_urut_pemohon', 'kd_jns_op_pemohon'], 'required'],
            [['pct_permohonan_pengurangan'], 'number'],
            [['createdby', 'updatedby'], 'default', 'value' => null],
            [['createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['kd_kanwil', 'kd_kantor', 'kd_propinsi_pemohon', 'kd_dati2_pemohon'], 'string', 'max' => 2],
            [['thn_pelayanan', 'bundel_pelayanan', 'no_urut_pemohon'], 'string', 'max' => 4],
            [['no_urut_pelayanan', 'kd_kecamatan_pemohon', 'kd_kelurahan_pemohon', 'kd_blok_pemohon'], 'string', 'max' => 3],
            [['kd_jns_op_pemohon', 'jns_pengurangan'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_kanwil' => 'Kode Kanwil',
            'kd_kantor' => 'Kode Kantor',
            'thn_pelayanan' => 'Thn Pelayanan',
            'bundel_pelayanan' => 'Bundel Pelayanan',
            'no_urut_pelayanan' => 'No Urut Pelayanan',
            'kd_propinsi_pemohon' => 'Kode Propinsi',
            'kd_dati2_pemohon' => 'Kode Dati 2',
            'kd_kecamatan_pemohon' => 'Kode Kecamatan',
            'kd_kelurahan_pemohon' => 'Kode Kelurahan',
            'kd_blok_pemohon' => 'Kode Blok',
            'no_urut_pemohon' => 'No Urut',
            'kd_jns_op_pemohon' => 'Kode Jenis Objek Pajak',
            'jns_pengurangan' => 'Jenis Pengurangan',
            'pct_permohonan_pengurangan' => 'Persen Pengurangan',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
