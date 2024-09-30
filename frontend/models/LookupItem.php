<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pbb.lookup_item".
 *
 * @property string $kd_lookup_group
 * @property string $kd_lookup_item
 * @property string|null $nm_lookup_item
 * @property int $createdby
 * @property string $createdtime
 * @property int $updatedby
 * @property string $updatedtime
 */
class LookupItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pbb.lookup_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_lookup_group', 'kd_lookup_item'], 'required'],
            [['createdby', 'updatedby'], 'default', 'value' => null],
            [['createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['kd_lookup_group'], 'string', 'max' => 2],
            [['kd_lookup_item'], 'string', 'max' => 1],
            [['nm_lookup_item'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kd_lookup_group' => 'Kd Lookup Group',
            'kd_lookup_item' => 'Kd Lookup Item',
            'nm_lookup_item' => 'Nm Lookup Item',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
