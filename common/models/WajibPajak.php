<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class WajibPajak extends ActiveRecord
{
    public static function tableName()
    {
        return 'nama_tabel_wajib_pajak';
    }

    public function rules()
    {
        return [
            [['nik', 'nama', 'jalan', 'handphone'], 'required'],
            [['nik'], 'string', 'max' => 16],
            [['nama', 'jalan'], 'string', 'max' => 255],
            [['handphone'], 'string', 'max' => 15],
            [['npwp'], 'string', 'max' => 20],
        ];
    }
}
