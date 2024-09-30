<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use frontend\models\Aduan;
use frontend\models\AttachmentAduan;
use common\models\User;

/**
 * This is the model class for table "epbb.balasan_aduan".
 *
 * @property int $id
 * @property int $id_aduan
 * @property string $tipe_user
 * @property string $isi
 * @property int|null $createdby
 * @property string|null $createdtime
 * @property int|null $updatedby
 * @property string|null $updatedtime
 */
class BalasanAduan extends \yii\db\ActiveRecord
{

    const TIPE_STATUS = '1';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epbb.balasan_aduan';
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
            [['id_aduan', 'tipe_user', 'isi'], 'required'],
            [['id_aduan', 'createdby', 'updatedby'], 'default', 'value' => null],
            [['id_aduan', 'createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['tipe_user'], 'string', 'max' => 1],
            [['isi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_aduan' => 'Id Aduan',
            'tipe_user' => 'Tipe User',
            'isi' => 'Isi',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Updatedtime',
        ];
    }

    public function getAduan()
    {
        return $this->hasOne(Aduan::class, ['id_aduan' => 'id']);
    }

    public function getAttach()
    {
        return $this->hasOne(AttachmentAduan::class, ['id_balasan' => 'id']);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'createdby']);
    }
}
