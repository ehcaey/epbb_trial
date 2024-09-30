<?php

namespace frontend\controllers;

use Yii;
use Carbon\Carbon;
use Exception;
use frontend\models\ObjekPajak;
use frontend\models\ObjekPajakSearch;
use frontend\models\OpBumi;
use frontend\models\OpBangunan;
use frontend\models\SubjekPajak;
use frontend\models\Referensi\JenisTanah;
use frontend\models\Referensi\Kelurahan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ObjekPajakController implements the CRUD actions for ObjekPajak model.
 */
class ObjekPajakController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'get-data-objek-pajak'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'get-data-objek-pajak'],
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
     * Lists all ObjekPajak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjekPajakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ObjekPajak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // redirect ke data wajib pajak
        if (Yii::$app->user->identity->subjekPajak == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl("subjek-pajak/index"));
        }

        $modelObjekPajak = new ObjekPajak();
        $modelSubjekPajak = new SubjekPajak();
        $modelOpBumi = new OpBumi();
        $modelOpBangunan = new OpBangunan();
        $modelKelurahan = new Kelurahan();
        $modelJenisTanah = new JenisTanah();

        if (Yii::$app->request->isPost) {
            $inputObjekPajak = Yii::$app->request->post('ObjekPajak');

            $nop = $inputObjekPajak['kd_propinsi'] . $inputObjekPajak['kd_dati2'] . $inputObjekPajak['kd_kecamatan'] . $inputObjekPajak['kd_kelurahan'] . $inputObjekPajak['kd_blok'] . $inputObjekPajak['no_urut'] . $inputObjekPajak['kd_jns_op'];

            try {
                $objekPajak = ObjekPajak::findByNop($nop)->one();

                if (trim($objekPajak->subjek_pajak_id) != trim(Yii::$app->user->identity->nik)) {
                    throw new Exception('Objek Pajak terdaftar tidak sesuai dengan identitas Wajib Pajak.');
                }
                $objekPajak->epbb_user_id = Yii::$app->user->id;
                
                if (! $objekPajak->save()) {
                    Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat menyimpan Objek Pajak.');

                    return $this->redirect(['index']);
                } 

                Yii::$app->session->setFlash('success', 'Objek Pajak berhasil disimpan.');
            } catch (Exception $exception) {
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', compact(
            'modelJenisTanah', 
            'modelKelurahan', 
            'modelObjekPajak', 
            'modelOpBangunan', 
            'modelOpBumi', 
            'modelSubjekPajak'
        ));
    }

    /**
     * Deletes an existing ObjekPajak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $kd_propinsi
     * @param string $kd_dati2
     * @param string $kd_kecamatan
     * @param string $kd_kelurahan
     * @param string $kd_blok
     * @param string $no_urut
     * @param string $kd_jns_op
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kd_propinsi, $kd_dati2, $kd_kecamatan, $kd_kelurahan, $kd_blok, $no_urut, $kd_jns_op)
    {
        $nop = $kd_propinsi . $kd_dati2 . $kd_kecamatan . $kd_kelurahan . $kd_blok . $no_urut . $kd_jns_op;

        $objekPajak = ObjekPajak::findByNop($nop)->one();

        $objekPajak->epbb_user_id = null;
        $objekPajak->save();

        return $this->redirect(['index']);
    }

    public function actionGetDataObjekPajak($nop)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $objekPajak = ObjekPajak::findByNop($nop)
            ->with([
                'subjekPajak', 
                'kelurahan', 
                'statusWajibPajak', 
                'subjekPajak.pekerjaan', 
                'bumi',
                'bangunan',
            ])
            ->one();

        if ($objekPajak === null || strlen($nop) <> 18) {
            throw new NotFoundHttpException('Data objek pajak tidak ditemukan.');
        }

        if (trim($objekPajak->subjek_pajak_id) != trim(Yii::$app->user->identity->nik)) {
            throw new Exception('Objek Pajak terdaftar tidak sesuai dengan identitas Wajib Pajak.');
        }

        $dataLetakObjekPajak = [
            'jalan_op' => $objekPajak->jalan_op,
            'blok_kav_no_op' => $objekPajak->blok_kav_no_op,
            'nm_kelurahan' => $objekPajak->kelurahan->nm_kelurahan,
            'rw_op' => $objekPajak->rw_op,
            'rt_op' => $objekPajak->rt_op,
            'no_persil' => $objekPajak->no_persil,
        ];
        
        $dataSubjekPajak = [
            'subjek_pajak_id' => $objekPajak->subjek_pajak_id,
            'status_pekerjaan_wp' => (isset($objekPajak->subjekPajak->pekerjaan)) ? $objekPajak->subjekPajak->pekerjaan->nama : '',
            'nm_wp' => $objekPajak->subjekPajak->nm_wp,
            'status_wp' => $objekPajak->statusWajibPajak->nama,
            'jalan_wp' => $objekPajak->subjekPajak->jalan_wp,
            'npwp' => $objekPajak->subjekPajak->npwp,
            'blok_kav_no_wp' => $objekPajak->subjekPajak->blok_kav_no_wp,
            'rw_wp' => $objekPajak->subjekPajak->rw_wp,
            'rt_wp' => $objekPajak->subjekPajak->rt_wp,
            'kelurahan_wp' => $objekPajak->subjekPajak->kelurahan_wp,
            'kota_wp' => $objekPajak->subjekPajak->kota_wp,
            'kd_pos_wp' => $objekPajak->subjekPajak->kd_pos_wp,
            'telp_wp' => $objekPajak->subjekPajak->telp_wp,
        ];

        $dataBumi = [
            'luas_bumi' => $objekPajak->bumi->luas_bumi,
            'kd_znt' => $objekPajak->bumi->kd_znt,
            'jns_bumi' => $objekPajak->bumi->jenisTanah->nama,
        ];

        $dataBangunan = [
            'jumlah_bangunan' => count($objekPajak->bangunan),
        ];

        $identitasPendata = [
            'tgl_pendataan_op' => (isset($objekPajak->tgl_pendataan_op)) ? (new Carbon($objekPajak->tgl_pendataan_op))->format('d/m/Y') : '',
            'nip_pendata' => $objekPajak->nip_pendata,
            'tgl_pemeriksaan_op' => (isset($objekPajak->tgl_pemeriksaan_op)) ? (new Carbon($objekPajak->tgl_pemeriksaan_op))->format('d/m/Y') : '',
            'nip_pemeriksa_op' => $objekPajak->nip_pemeriksa_op,
            'tgl_perekaman_op' => (isset($objekPajak->tgl_perekaman_op)) ? (new Carbon($objekPajak->tgl_perekaman_op))->format('d/m/Y') : '',
            'nip_perekam_op' => $objekPajak->nip_perekam_op,
        ];

        $output = [
            'data' => [
                'kd_propinsi' => $objekPajak->kd_propinsi,
                'kd_dati2' => $objekPajak->kd_dati2,
                'kd_kecamatan' => $objekPajak->kd_kecamatan,
                'kd_kelurahan' => $objekPajak->kd_kelurahan,
                'kd_blok' => $objekPajak->kd_blok,
                'no_urut' => $objekPajak->no_urut,
                'kd_jns_op' => $objekPajak->kd_jns_op,
                'no_formulir_spop' => $objekPajak->no_formulir_spop,
                'data_letak_objek_pajak' => $dataLetakObjekPajak,
                'data_subjek_pajak' => $dataSubjekPajak,
                'data_bumi' => $dataBumi,
                'data_bangunan' => $dataBangunan,
                'identitas_pendata' => $identitasPendata,
            ],
            'status' => 'OK'
        ];

        return $output;
    }
}
