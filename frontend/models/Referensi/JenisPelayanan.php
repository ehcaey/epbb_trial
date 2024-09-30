<?php

namespace frontend\models\Referensi;

use Yii;

/**
 * This is the model class for table "pbb.ref_jns_pelayanan".
 *
 * @property string $kd_jns_pelayanan
 * @property string|null $nm_jenis_pelayanan
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class JenisPelayanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.ref_jns_pelayanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_jns_pelayanan'], 'required'],
            [['createdby', 'updatedby'], 'default', 'value' => null],
            [['createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['kd_jns_pelayanan'], 'string', 'max' => 2],
            [['nm_jenis_pelayanan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_jns_pelayanan' => 'Kd Jns Pelayanan',
            'nm_jenis_pelayanan' => 'Nm Jenis Pelayanan',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
