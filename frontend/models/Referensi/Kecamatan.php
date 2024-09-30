<?php

namespace frontend\models\Referensi;

use Yii;

/**
 * This is the model class for table "pbb.ref_kecamatan".
 *
 * @property string $kd_propinsi
 * @property string $kd_dati2
 * @property string $kd_kecamatan
 * @property string|null $nm_kecamatan
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.ref_kecamatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_propinsi', 'kd_dati2', 'kd_kecamatan'], 'required'],
            [['createdby', 'updatedby'], 'default', 'value' => null],
            [['createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['kd_propinsi', 'kd_dati2'], 'string', 'max' => 2],
            [['kd_kecamatan'], 'string', 'max' => 3],
            [['nm_kecamatan'], 'string', 'max' => 30],
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
            'nm_kecamatan' => 'Nm Kecamatan',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
