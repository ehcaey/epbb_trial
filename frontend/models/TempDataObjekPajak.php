<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pbb.temp_data_op".
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
 * @property string $temp_jns_data
 * @property int|null $temp_siklus_sppt
 * @property string|null $temp_nm_wp
 * @property string|null $temp_jalan_op
 * @property string|null $temp_blok_kav_no_op
 * @property string|null $temp_rw_op
 * @property string|null $temp_rt_op
 * @property string|null $temp_jalan_wp
 * @property string|null $temp_blok_kav_no_wp
 * @property string|null $temp_rw_wp
 * @property string|null $temp_rt_wp
 * @property string|null $temp_kelurahan_wp
 * @property string|null $temp_kota_wp
 * @property string|null $temp_kd_pos_wp
 * @property string|null $temp_npwp
 * @property string|null $temp_subjek_pajak_id
 * @property string|null $kd_kls_tanah
 * @property string|null $thn_awal_kls_tanah
 * @property string|null $kd_kls_bng
 * @property string|null $thn_awal_kls_bng
 * @property int|null $temp_luas_bumi
 * @property int|null $temp_luas_bangunan
 * @property int|null $temp_njop_bumi
 * @property int|null $temp_njop_bangunan
 * @property int|null $temp_njop
 * @property int|null $temp_njoptkp
 * @property int|null $temp_pbb_terhutang
 * @property int|null $temp_besar_denda
 * @property int|null $temp_faktor_pengurang
 * @property int|null $temp_pbb_yg_harus_dibayar
 * @property string|null $temp_tgl_jatuh_tempo
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class TempDataObjekPajak extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.temp_data_op';
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
            [['kd_kanwil', 'kd_kantor', 'thn_pelayanan', 'bundel_pelayanan', 'no_urut_pelayanan', 'kd_propinsi_pemohon', 'kd_dati2_pemohon', 'kd_kecamatan_pemohon', 'kd_kelurahan_pemohon', 'kd_blok_pemohon', 'no_urut_pemohon', 'kd_jns_op_pemohon', 'temp_jns_data'], 'required'],
            [['temp_siklus_sppt', 'temp_luas_bumi', 'temp_luas_bangunan', 'temp_njop_bumi', 'temp_njop_bangunan', 'temp_njop', 'temp_njoptkp', 'temp_pbb_terhutang', 'temp_besar_denda', 'temp_faktor_pengurang', 'temp_pbb_yg_harus_dibayar', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['temp_siklus_sppt', 'temp_luas_bumi', 'temp_luas_bangunan', 'temp_njop_bumi', 'temp_njop_bangunan', 'temp_njop', 'temp_njoptkp', 'temp_pbb_terhutang', 'temp_besar_denda', 'temp_faktor_pengurang', 'temp_pbb_yg_harus_dibayar', 'createdby', 'updatedby'], 'integer'],
            [['temp_tgl_jatuh_tempo', 'createdtime', 'updatedtime'], 'safe'],
            [['kd_kanwil', 'kd_kantor', 'kd_propinsi_pemohon', 'kd_dati2_pemohon', 'temp_rw_op', 'temp_rw_wp'], 'string', 'max' => 2],
            [['thn_pelayanan', 'bundel_pelayanan', 'no_urut_pemohon', 'thn_awal_kls_tanah', 'thn_awal_kls_bng'], 'string', 'max' => 4],
            [['no_urut_pelayanan', 'kd_kecamatan_pemohon', 'kd_kelurahan_pemohon', 'kd_blok_pemohon', 'temp_rt_op', 'temp_rt_wp', 'kd_kls_tanah', 'kd_kls_bng'], 'string', 'max' => 3],
            [['kd_jns_op_pemohon', 'temp_jns_data'], 'string', 'max' => 1],
            [['temp_nm_wp', 'temp_jalan_op', 'temp_jalan_wp', 'temp_kelurahan_wp', 'temp_kota_wp', 'temp_subjek_pajak_id'], 'string', 'max' => 30],
            [['temp_blok_kav_no_op', 'temp_blok_kav_no_wp', 'temp_npwp'], 'string', 'max' => 15],
            [['temp_kd_pos_wp'], 'string', 'max' => 5],
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
            'kd_propinsi_pemohon' => 'Kd Propinsi Pemohon',
            'kd_dati2_pemohon' => 'Kd Dati2 Pemohon',
            'kd_kecamatan_pemohon' => 'Kd Kecamatan Pemohon',
            'kd_kelurahan_pemohon' => 'Kd Kelurahan Pemohon',
            'kd_blok_pemohon' => 'Kd Blok Pemohon',
            'no_urut_pemohon' => 'No Urut Pemohon',
            'kd_jns_op_pemohon' => 'Kd Jns Op Pemohon',
            'temp_jns_data' => 'Temp Jns Data',
            'temp_siklus_sppt' => 'Temp Siklus Sppt',
            'temp_nm_wp' => 'Temp Nm Wp',
            'temp_jalan_op' => 'Temp Jalan Op',
            'temp_blok_kav_no_op' => 'Temp Blok Kav No Op',
            'temp_rw_op' => 'Temp Rw Op',
            'temp_rt_op' => 'Temp Rt Op',
            'temp_jalan_wp' => 'Temp Jalan Wp',
            'temp_blok_kav_no_wp' => 'Temp Blok Kav No Wp',
            'temp_rw_wp' => 'Temp Rw Wp',
            'temp_rt_wp' => 'Temp Rt Wp',
            'temp_kelurahan_wp' => 'Temp Kelurahan Wp',
            'temp_kota_wp' => 'Temp Kota Wp',
            'temp_kd_pos_wp' => 'Temp Kd Pos Wp',
            'temp_npwp' => 'Temp Npwp',
            'temp_subjek_pajak_id' => 'Temp Subjek Pajak ID',
            'kd_kls_tanah' => 'Kd Kls Tanah',
            'thn_awal_kls_tanah' => 'Thn Awal Kls Tanah',
            'kd_kls_bng' => 'Kd Kls Bng',
            'thn_awal_kls_bng' => 'Thn Awal Kls Bng',
            'temp_luas_bumi' => 'Temp Luas Bumi',
            'temp_luas_bangunan' => 'Temp Luas Bangunan',
            'temp_njop_bumi' => 'Temp Njop Bumi',
            'temp_njop_bangunan' => 'Temp Njop Bangunan',
            'temp_njop' => 'Temp Njop',
            'temp_njoptkp' => 'Temp Njoptkp',
            'temp_pbb_terhutang' => 'Temp Pbb Terhutang',
            'temp_besar_denda' => 'Temp Besar Denda',
            'temp_faktor_pengurang' => 'Temp Faktor Pengurang',
            'temp_pbb_yg_harus_dibayar' => 'Temp Pbb Yg Harus Dibayar',
            'temp_tgl_jatuh_tempo' => 'Temp Tgl Jatuh Tempo',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
