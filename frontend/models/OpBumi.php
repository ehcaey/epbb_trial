<?php

namespace frontend\models;

use frontend\models\Referensi\JenisTanah;
use Yii;

/**
 * This is the model class for table "pbb.dat_op_bumi".
 *
 * @property string $kd_propinsi
 * @property string $kd_dati2
 * @property string $kd_kecamatan
 * @property string $kd_kelurahan
 * @property string $kd_blok
 * @property string $no_urut
 * @property string $kd_jns_op
 * @property int $no_bumi
 * @property string|null $kd_znt
 * @property int|null $luas_bumi
 * @property string|null $jns_bumi
 * @property int|null $nilai_sistem_bumi
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 * @property string|null $flag
 */
class OpBumi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.dat_op_bumi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'no_urut', 'kd_jns_op'], 'required'],
            [['no_bumi', 'luas_bumi', 'nilai_sistem_bumi', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['no_bumi', 'luas_bumi', 'nilai_sistem_bumi', 'createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['kd_propinsi', 'kd_dati2', 'kd_znt'], 'string', 'max' => 2],
            [['kd_kecamatan', 'kd_kelurahan', 'kd_blok'], 'string', 'max' => 3],
            [['no_urut'], 'string', 'max' => 4],
            [['kd_jns_op', 'jns_bumi', 'flag'], 'string', 'max' => 1],
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
            'kd_jns_op' => 'Kode Jenis OP',
            'no_bumi' => 'No Bumi',
            'kd_znt' => 'Kode ZNT',
            'luas_bumi' => 'Luas Bumi',
            'jns_bumi' => 'Jenis Bumi',
            'nilai_sistem_bumi' => 'Nilai Sistem Bumi',
            'createdby' => 'Created by',
            'createdtime' => 'Created time',
            'updatedby' => 'Updated by',
            'updatedtime' => 'Updated time',
            'flag' => 'Flag',
        ];
    }

    public function getJenisTanah()
    {
        return $this->hasOne(JenisTanah::class, ['kode' => 'jns_bumi']);
    }
}
