<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "epbb.virtual_account_detail".
 *
 * @property int $id
 * @property string $no_va
 * @property string $tahun_pajak
 * @property float|null $jumlah_pajak
 * @property float|null $denda_pajak
 * @property float|null $biaya_admin
 * @property int|null $createdby
 * @property string|null $createdtime
 * @property int|null $updatedby
 * @property string|null $updatedtime
 */
class VirtualAccountDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epbb.virtual_account_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_va', 'tahun_pajak'], 'required'],
            [['jumlah_pajak', 'denda_pajak'], 'number'],
            [['createdby', 'updatedby'], 'default', 'value' => null],
            [['createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['no_va'], 'string', 'max' => 20],
            [['tahun_pajak'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_va' => 'No Va',
            'tahun_pajak' => 'Tahun Pajak',
            'jumlah_pajak' => 'Jumlah Pajak',
            'denda_pajak' => 'Denda Pajak',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
