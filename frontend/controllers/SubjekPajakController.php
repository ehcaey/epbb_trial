<?php

namespace frontend\controllers;

use aryelds\sweetalert\SweetAlert;
use Yii;
use frontend\models\SubjekPajak;
use frontend\models\SubjekPajakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Referensi\Pekerjaan;
use common\models\User;
use yii\filters\AccessControl;

/**
 * SubjekPajakController implements the CRUD actions for SubjekPajak model.
 */
class SubjekPajakController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'get-data-wp'],
                'rules' => [
                    [
                        'actions' => ['index', 'get-data-wp'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SubjekPajak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelUser = User::findIdentity(Yii::$app->user->getId());
        
        if (Yii::$app->request->post()) {
            $transaction = Yii::$app->db->beginTransaction();

            $input = Yii::$app->request->post('SubjekPajak');

            // $model = (SubjekPajak::find()->where(['subjek_pajak_id' => $input['subjek_pajak_id']])->one()) ?: new SubjekPajak();

            $model = SubjekPajak::find()->where(['subjek_pajak_id' => $input['subjek_pajak_id']])->one();

            if(empty($model)){
                Yii::$app->session->setFlash('error', 'NIK Tidak Terdaftar.');
                return $this->redirect(['index']);
            }

            $model->load(Yii::$app->request->post());

            if (! $model->save()) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat menyimpan Data Wajib Pajak.');
                return $this->redirect(['index']);
            }

            $modelUser->nik = $model->subjek_pajak_id;
            
            if (! $modelUser->save()) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat menyimpan NIK.');
                return $this->redirect(['index']);
            }

            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Data berhasil disimpan.');

            return $this->redirect(['index']);
        }

        $pekerjaanList = Pekerjaan::find()->select([trim('kode'), 'nama'])->asArray()->all();

        if ($modelUser->nik == null) {
            $model = new SubjekPajak();
        } else {
            $model = SubjekPajak::find()->where(['subjek_pajak_id' => $modelUser->nik])->one();

            if($model == null){
                $model = new SubjekPajak();
            } else {
                $model->subjek_pajak_id = trim($model->subjek_pajak_id);
                $model->status_pekerjaan_wp = $model->status_pekerjaan_wp . ' ';
            }
        }


        echo SweetAlert::widget([
            'options' => [
                'title' => "Penting! Harap isi kolom pada tabel Identitas Wajib Pajak dengan lengkap dan benar:",
                'text' => "NIK: Masukkan sesuai dengan NIK pada KTP.\n" .
                          "Nama: Isi dengan nama lengkap pemilik objek pajak.\n" .
                          "Alamat: Gunakan alamat sesuai KTP atau domisili.\n" .
                          "Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi: Isi dengan nama wilayah sesuai dengan KTP atau domisili.\n" .
                          "Nomor Handphone: Pastikan nomor yang dimasukkan aktif dan benar.\n" .
                          "Email: Masukkan email aktif yang bisa dihubungi.\n" .
                          "Pastikan semua data terisi dengan benar untuk kelancaran proses perpajakan.",
                'icon' => 'warning',
                'confirmButtonText' => 'OK',
                'showCloseButton' => true,
            ]
        ]);
        

        return $this->render('create', compact('model', 'pekerjaanList'));
    }

    public function actionGetDataWp(){
        $nik = filter_input(INPUT_POST, 'nik');
        $dataWP = SubjekPajak::find()->where(['subjek_pajak_id' => $nik])->one();
        
        if($dataWP != null) {
            $json = [
                'subjek_pajak_id' => $dataWP->subjek_pajak_id, 
                'kota_wp' => $dataWP->kota_wp, 
                'nm_wp' => $dataWP->nm_wp, 
                'kelurahan_wp' => $dataWP->kelurahan_wp, 
                'npwp' => $dataWP->npwp, 
                'rt_wp' => $dataWP->rt_wp, 
                'rw_wp' => $dataWP->rw_wp, 
                'status_pekerjaan_wp' => $dataWP->status_pekerjaan_wp, 
                'jalan_wp' => $dataWP->jalan_wp, 
                'telp_wp' => $dataWP->telp_wp, 
                'blok_kav_no_wp' => $dataWP->blok_kav_no_wp, 
                'handphone' => $dataWP->handphone, 
                'kd_pos_wp' => $dataWP->kd_pos_wp
            ];

            echo json_encode($json);
        } else {
            Yii::$app->session->setFlash('error', 'NIK Tidak Terdaftar.');
            return $this->redirect(['index']);
        }
    }
}
