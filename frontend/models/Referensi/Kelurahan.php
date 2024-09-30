<?php

namespace frontend\models\Referensi;

use Yii;

/**
 * This is the model class for table "pbb.ref_kelurahan".
 *
 * @property string $kd_propinsi
 * @property string $kd_dati2
 * @property string $kd_kecamatan
 * @property string $kd_kelurahan
 * @property string|null $kd_sektor
 * @property string|null $nm_kelurahan
 * @property int|null $no_kelurahan
 * @property string|null $kd_pos_kelurahan
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class Kelurahan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.ref_kelurahan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan'], 'required'],
            [['no_kelurahan', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['no_kelurahan', 'createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['kd_propinsi', 'kd_dati2', 'kd_sektor'], 'string', 'max' => 2],
            [['kd_kecamatan', 'kd_kelurahan'], 'string', 'max' => 3],
            [['nm_kelurahan'], 'string', 'max' => 30],
            [['kd_pos_kelurahan'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_propinsi' => 'Kode Propinsi',
            'kd_dati2' => 'Kode Dati2',
            'kd_kecamatan' => 'Kode Kecamatan',
            'kd_kelurahan' => 'Kode Kelurahan',
            'kd_sektor' => 'Kode Sektor',
            'nm_kelurahan' => 'Nama Kelurahan',
            'no_kelurahan' => 'No Kelurahan',
            'kd_pos_kelurahan' => 'Kode Pos Kelurahan',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
