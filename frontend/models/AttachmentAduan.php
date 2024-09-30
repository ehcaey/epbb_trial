<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use frontend\models\BalasanAduan;

/**
 * This is the model class for table "epbb.attachment_aduan".
 *
 * @property int $id
 * @property int $id_balasan
 * @property string $file_name
 * @property int|null $createdby
 * @property string|null $createdtime
 * @property int|null $updatedby
 * @property string|null $updatedtime
 */
class AttachmentAduan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epbb.attachment_aduan';
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
            [['id_balasan'], 'required'],
            [['id_balasan', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['id_balasan', 'createdby', 'updatedby'], 'integer'],
            [['file_name'], 'file', 'extensions' => 'pdf, doc, docx, xls, xlsx, zip', 'maxSize' => '8388608'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_balasan' => 'Id Balasan',
            'file_name' => 'File Name',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }

    public function getBalasan()
    {
        return $this->hasOne(BalasanAduan::class, ['id_balasan' => 'id']);
    }
}
