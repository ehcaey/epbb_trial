<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pbb.pembayaran_sppt".
 *
 * @property string|null $kd_propinsi
 * @property string|null $kd_dati2
 * @property string|null $kd_kecamatan
 * @property string|null $kd_kelurahan
 * @property string|null $kd_blok
 * @property string|null $no_urut
 * @property string|null $kd_jns_op
 * @property string|null $thn_pajak_sppt
 * @property int|null $pembayaran_sppt_ke
 * @property string|null $kd_kanwil
 * @property string|null $kd_kantor
 * @property string|null $kd_tp
 * @property int|null $denda_sppt
 * @property int|null $jml_sppt_yg_dibayar
 * @property string|null $tgl_pembayaran_sppt
 * @property string|null $tgl_rekam_byr_sppt
 * @property string|null $nip_rekam_byr_sppt
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 * @property string|null $flag
 */
class PembayaranSppt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.pembayaran_sppt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pembayaran_sppt_ke', 'denda_sppt', 'jml_sppt_yg_dibayar', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['pembayaran_sppt_ke', 'denda_sppt', 'jml_sppt_yg_dibayar', 'createdby', 'updatedby'], 'integer'],
            [['tgl_pembayaran_sppt', 'tgl_rekam_byr_sppt', 'createdtime', 'updatedtime'], 'safe'],
            [['kd_propinsi', 'kd_dati2', 'kd_kanwil', 'kd_kantor', 'kd_tp', 'flag'], 'string', 'max' => 2],
            [['kd_kecamatan', 'kd_kelurahan', 'kd_blok'], 'string', 'max' => 3],
            [['no_urut', 'thn_pajak_sppt'], 'string', 'max' => 4],
            [['kd_jns_op'], 'string', 'max' => 1],
            [['nip_rekam_byr_sppt'], 'string', 'max' => 18],
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
            'pembayaran_sppt_ke' => 'Pembayaran Sppt Ke',
            'kd_kanwil' => 'Kd Kanwil',
            'kd_kantor' => 'Kd Kantor',
            'kd_tp' => 'Kd Tp',
            'denda_sppt' => 'Denda Sppt',
            'jml_sppt_yg_dibayar' => 'Jml Sppt Yg Dibayar',
            'tgl_pembayaran_sppt' => 'Tgl Pembayaran Sppt',
            'tgl_rekam_byr_sppt' => 'Tgl Rekam Byr Sppt',
            'nip_rekam_byr_sppt' => 'Nip Rekam Byr Sppt',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
            'flag' => 'Flag',
        ];
    }
}
