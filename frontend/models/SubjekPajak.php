<?php

namespace frontend\models;

use frontend\models\Referensi\Pekerjaan;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "pbb.dat_subjek_pajak".
 *
 * @property string $subjek_pajak_id
 * @property string|null $nm_wp
 * @property string|null $jalan_wp
 * @property string|null $blok_kav_no_wp
 * @property string|null $rw_wp
 * @property string|null $rt_wp
 * @property string|null $kelurahan_wp
 * @property string|null $kota_wp
 * @property string|null $kd_pos_wp
 * @property string|null $telp_wp
 * @property string|null $npwp
 * @property string|null $status_pekerjaan_wp
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 * @property string|null $handphone
 */
class SubjekPajak extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.dat_subjek_pajak';
    }

    /**
     * {@inheritdoc}
     */
    public static function primaryKey()
    {
        return ['subjek_pajak_id'];
    }

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
            [['subjek_pajak_id', 'jalan_wp', 'handphone'], 'required'],
            // [['createdby', 'updatedby'], 'default', 'value' => null],
            // [['createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['subjek_pajak_id'], 'string', 'length' => 16],
            [['nm_wp', 'jalan_wp'], 'string', 'max' => 30],
            [['blok_kav_no_wp', 'npwp'], 'string', 'max' => 15],
            [['rw_wp'], 'string', 'max' => 2],
            [['rt_wp'], 'string', 'max' => 3],
            [['kelurahan_wp', 'kota_wp'], 'string', 'max' => 50],
            [['kd_pos_wp'], 'string', 'max' => 5],
            [['telp_wp', 'handphone'], 'string', 'max' => 20],
            // [['status_pekerjaan_wp'], 'string', 'max' => 1],
            [['nm_wp', 'subjek_pajak_id'], 'unique', 'targetAttribute' => ['nm_wp', 'subjek_pajak_id']],
            [['jalan_wp', 'blok_kav_no_wp', 'rw_wp', 'rt_wp', 'subjek_pajak_id'], 'unique', 'targetAttribute' => ['jalan_wp', 'blok_kav_no_wp', 'rw_wp', 'rt_wp', 'subjek_pajak_id']],
            [['status_pekerjaan_wp', 'subjek_pajak_id'], 'unique', 'targetAttribute' => ['status_pekerjaan_wp', 'subjek_pajak_id']],
            [['npwp', 'subjek_pajak_id'], 'unique', 'targetAttribute' => ['npwp', 'subjek_pajak_id']],
            [['subjek_pajak_id'], 'unique'],
            // [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => PbbUsers::className(), 'targetAttribute' => ['createdby' => 'id']],
            // [['updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => PbbUsers::className(), 'targetAttribute' => ['updatedby' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subjek_pajak_id' => 'NIK',
            'nm_wp' => 'Nama',
            'jalan_wp' => 'Jalan',
            'blok_kav_no_wp' => 'Blok/Kav/No',
            'rw_wp' => 'RW',
            'rt_wp' => 'RT',
            'kelurahan_wp' => 'Kelurahan',
            'kota_wp' => 'Kota',
            'kd_pos_wp' => 'Kode Pos',
            'telp_wp' => 'Telepon',
            'npwp' => 'NPWP',
            'status_pekerjaan_wp' => 'Status Pekerjaan',
            // 'createdby' => 'Createdby',
            // 'createdtime' => 'Createdtime',
            // 'updatedby' => 'Updatedby',
            // 'updatedtime' => 'Updatedtime',
            'handphone' => 'Handphone',
        ];
    }

    public function getPekerjaan()
    {
        return $this->hasOne(Pekerjaan::class, ['kode' => 'status_pekerjaan_wp']);
    }
}
