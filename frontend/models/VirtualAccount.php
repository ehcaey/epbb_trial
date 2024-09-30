<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "epbb.virtual_account".
 *
 * @property int $id
 * @property string $no_va
 * @property string $kd_propinsi
 * @property string $kd_dati2
 * @property string $kd_kecamatan
 * @property string $kd_kelurahan
 * @property string $kd_blok
 * @property string $no_urut
 * @property string $kd_jns_op
 * @property string|null $alamat_op
 * @property string|null $kota_op
 * @property int|null $no_arsip
 * @property string|null $tgl_pembayaran
 * @property int|null $status_pembayaran
 * @property string|null $tgl_rekon
 * @property int|null $status_rekon
 * @property string|null $tgl_reversal
 * @property int|null $status_reversal
 * @property int|null $createdby
 * @property string|null $createdtime
 * @property int|null $updatedby
 * @property string|null $updatedtime
 */
class VirtualAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epbb.virtual_account';
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
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_va', 'kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'no_urut', 'kd_jns_op'], 'required'],
            [['no_arsip', 'status_pembayaran', 'status_rekon', 'status_reversal', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['no_arsip', 'status_pembayaran', 'status_rekon', 'status_reversal', 'createdby', 'updatedby'], 'integer'],
            [['tgl_pembayaran', 'tgl_rekon', 'tgl_reversal', 'createdtime', 'updatedtime'], 'safe'],
            [['no_va'], 'string', 'max' => 20],
            [['kd_propinsi', 'kd_dati2'], 'string', 'max' => 2],
            [['kd_kecamatan', 'kd_kelurahan', 'kd_blok'], 'string', 'max' => 3],
            [['no_urut'], 'string', 'max' => 4],
            [['kd_jns_op'], 'string', 'max' => 1],
            [['alamat_op'], 'string', 'max' => 255],
            [['kota_op'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_va' => 'No. Virtual Account',
            'kd_propinsi' => 'Kd Propinsi',
            'kd_dati2' => 'Kd Dati2',
            'kd_kecamatan' => 'Kd Kecamatan',
            'kd_kelurahan' => 'Kd Kelurahan',
            'kd_blok' => 'Kd Blok',
            'no_urut' => 'No Urut',
            'kd_jns_op' => 'Kd Jns Op',
            'alamat_op' => 'Alamat Objek Pajak',
            'kota_op' => 'Kota Objek Pajak',
            'no_arsip' => 'No Arsip',
            'tgl_pembayaran' => 'Tgl Pembayaran',
            'status_pembayaran' => 'Status Pembayaran',
            'tgl_rekon' => 'Tgl Rekon',
            'status_rekon' => 'Status Rekon',
            'tgl_reversal' => 'Tgl Reversal',
            'status_reversal' => 'Status Reversal',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }

    public function getNop()
    {
        return $this->kd_propinsi . $this->kd_dati2 . $this->kd_kecamatan . $this->kd_kelurahan . $this->kd_blok . $this->no_urut . $this->kd_jns_op;
    }

    public function getDetails()
    {
        return $this->hasMany(VirtualAccountDetail::class, ['no_va' => 'no_va']);
    }
}
