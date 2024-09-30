<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "epbb.counter".
 *
 * @property int|null $counter
 * @property string|null $updatedtime
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epbb.counter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['counter'], 'default', 'value' => null],
            [['counter'], 'integer'],
            [['updatedtime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'counter' => 'Counter',
            'updatedtime' => 'Updatedtime',
        ];
    }
}
