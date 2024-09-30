<?php

namespace frontend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use frontend\models\BalasanAduan;
use common\models\User;

/**
 * This is the model class for table "epbb.aduan".
 *
 * @property int $id
 * @property string $subjek
 * @property string $status
 * @property int|null $createdby
 * @property string|null $createdtime
 * @property int|null $updatedby
 * @property string|null $updatedtime
 */
class Aduan extends \yii\db\ActiveRecord
{

    const STATUS_DEFAULT = '1';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epbb.aduan';
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
            [['subjek', 'status'], 'required'],
            [['createdby', 'updatedby'], 'default', 'value' => null],
            [['createdby', 'updatedby'], 'integer'],
            [['createdtime', 'updatedtime'], 'safe'],
            [['subjek'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subjek' => 'Subjek',
            'status' => 'Status',
            'createdby' => 'Createdby',
            'createdtime' => 'Createdtime',
            'updatedby' => 'Updatedby',
            'updatedtime' => 'Last Updated',
        ];
    }

    public function getBalasan()
    {
        return $this->hasMany(BalasanAduan::class, ['id' => 'id_aduan']);
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
