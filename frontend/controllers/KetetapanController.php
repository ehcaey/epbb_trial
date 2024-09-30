<?php

namespace frontend\controllers;

use Carbon\Carbon;
use Exception;
use frontend\models\Counter;
use frontend\models\ObjekPajak;
use frontend\models\ObjekPajakSearch;
use frontend\models\Sppt;
use frontend\models\VirtualAccount;
use frontend\models\VirtualAccountDetail;
use GuzzleHttp\Client;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\traits\Jasper;

/**
 * KetetapanController.
 */
class KetetapanController extends Controller
{

    use Jasper;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'cetak-sppt'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'cetak-sppt'],
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
     * Lists all ObjekPajak.
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
     * View ketetapan dan piutang
     */
    public function actionView($kd_propinsi, $kd_dati2, $kd_kecamatan, $kd_kelurahan, $kd_blok, $no_urut, $kd_jns_op)
    {
        // redirect ke data wajib pajak
        if (Yii::$app->user->identity->subjekPajak == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl("subjek-pajak/index"));
        }

        $nop = $kd_propinsi . $kd_dati2 . $kd_kecamatan . $kd_kelurahan . $kd_blok . $no_urut . $kd_jns_op;

        $objekPajak = ObjekPajak::findByNop($nop)->with(['sppt' => function (ActiveQuery $query) {
            $query->orderBy('thn_pajak_sppt DESC');
        }, 'sppt.pembayaran'])->one();

        return $this->render('view', compact(
            'objekPajak', 'nop'
        ));
    }

    public function actionKonfirmasiPembayaran()
    {
        $objekPajak = null;
        $listSppt = null;

        $this->prepareSpptAkanDibayar($objekPajak, $listSppt, Yii::$app->request->get('ObjekPajak'), array_keys(Yii::$app->request->get('sppt')));

        return $this->renderAjax('_list_pembayaran', [
            'listSppt' => $listSppt,
            'objekPajak' => $objekPajak,
        ]);
    }

    public function actionGetVirtualAccount()
    {
        $objekPajak = null;
        $listSppt = null;

        $this->prepareSpptAkanDibayar($objekPajak, $listSppt, Yii::$app->request->get('ObjekPajak'), array_keys(Yii::$app->request->get('sppt')));

        $totalPajak = 0;
        $totalDenda = 0;
        $tahunString = '';
        
        try {

            foreach ($listSppt as $sppt) {
                $pajak = $sppt->pbb_yg_harus_dibayar_sppt;
                $denda = $sppt->denda;
    
                $totalPajak += $pajak;
                $totalDenda += $denda;
                
                $tahunString .= $sppt->thn_pajak_sppt . ',';
            }
    
            $biayaAdmin = Yii::$app->params['fee_ws'];
    
            $tahunString = substr($tahunString, 0, strlen($tahunString) - 1);
    
            $counter = Counter::find()->one();
                
            if ($counter == null) {
                $counter = new Counter();
                $counter->counter = 1;
                $counter->updatedtime = Carbon::now();
                $counter->save();
            } else {
                $updatedTime = Carbon::createFromFormat('Y-m-d H:i:s', $counter->updatedtime);
                $now = Carbon::now();
        
                if ($updatedTime->format('Ymd') < $now->format('Ymd')) {
                    $counter->counter = 1;
                } else {
                    $counter->counter += 1;
                }

                $counter->updatedtime = $now;
            }
            
            $counter->update();
            
            $transaction = Yii::$app->db->beginTransaction();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $nop = $objekPajak->kd_propinsi . $objekPajak->kd_dati2 . $objekPajak->kd_kecamatan . $objekPajak->kd_kelurahan . $objekPajak->kd_blok . $objekPajak->no_urut . $objekPajak->kd_jns_op;
    
            $body = [
                'command' => 'REGISTRASINOP',
                'counter' => $counter->counter,
                'signature' => md5(Yii::$app->params['password_ws'] . $counter->counter),
                'nop' => $nop,
                'tahun_pajak' => $tahunString,
                'tagihan' => round($totalPajak + $totalDenda + $biayaAdmin),
                'alamat' => $objekPajak->jalan_op,
                'kota' => Yii::$app->params['kota_op'],
            ];
    
            $client = new Client([
                'base_uri' => 'http://202.159.9.190:17094/',
                'timeout' => 60,
            ]);
    
            try {
                $response = $client->request('POST', 'REG', [
                    'json' => $body,
                ]);
                
                Yii::info('VA REQUEST: ' . json_encode($body), 'request');
                
                $body = $response->getBody();
    
                $object = json_decode((string) $body);

                Yii::info('VA RESPONSE: ' . $body, 'request');
                
                $result = $object; 
            } catch (RequestException $exception) {
                $transaction->rollBack();

                Yii::error('ERROR1205.' . $e->getMessage());

                return ['result' => 'Terjadi kesalahan, coba lagi.'];
            }

            $vas = (new Query())->select(['string_agg(tahun_pajak, \',\' ORDER BY tahun_pajak DESC) AS tahun_pajak, virtual_account.no_va'])
                ->from('epbb.virtual_account_detail')
                ->innerJoin('epbb.virtual_account', 'virtual_account.no_va = virtual_account_detail.no_va')
                ->where([
                    'kd_propinsi' => $objekPajak->kd_propinsi, 
                    'kd_dati2' => $objekPajak->kd_dati2, 
                    'kd_kecamatan' => $objekPajak->kd_kecamatan, 
                    'kd_kelurahan' => $objekPajak->kd_kelurahan, 
                    'kd_blok' => $objekPajak->kd_blok, 
                    'no_urut' => $objekPajak->no_urut, 
                    'kd_jns_op' => $objekPajak->kd_jns_op, 
                ])
                ->groupBy('virtual_account.no_va')
                ->all();

            $vaExists = false;
            $vaObj = null;

            foreach ($vas as $va) {
                if ($va['tahun_pajak'] == $tahunString) {
                    $vaExists = true;
                }

                $vaObj = $va;
            }
            
            if (! $vaExists) {
                $va = new VirtualAccount();
                $va->no_va = $result->nova;
                $va->kd_propinsi = $objekPajak->kd_propinsi;
                $va->kd_dati2 = $objekPajak->kd_dati2;
                $va->kd_kecamatan = $objekPajak->kd_kecamatan;
                $va->kd_kelurahan = $objekPajak->kd_kelurahan;
                $va->kd_blok = $objekPajak->kd_blok;
                $va->no_urut = $objekPajak->no_urut;
                $va->kd_jns_op = $objekPajak->kd_jns_op;
                $va->alamat_op = $result->alamat;
                $va->kota_op = $result->kota;
                $va->tagihan = $result->tagihan;
                $va->biaya_admin = $biayaAdmin;
                $va->save();
        
                foreach ($listSppt as $sppt) {
                    $vaDetail = new VirtualAccountDetail();
        
                    $vaDetail->no_va = $result->nova;
                    $vaDetail->jumlah_pajak = $sppt->pbb_yg_harus_dibayar_sppt;
                    $vaDetail->denda_pajak = $sppt->denda;
                    $vaDetail->tahun_pajak = $sppt->thn_pajak_sppt;
        
                    $vaDetail->save();
                }
            } else {
                $va = VirtualAccount::find()->where(['no_va' => $vaObj['no_va']])->one();
                $va->alamat_op = $result->alamat;
                $va->kota_op = $result->kota;
                $va->tagihan = $result->tagihan;
                $va->biaya_admin = $biayaAdmin;
                $va->update();

                foreach ($listSppt as $sppt) {
                    $vaDetail = VirtualAccountDetail::find()->where([
                        'no_va' => $va->no_va,
                        'tahun_pajak' => $sppt->thn_pajak_sppt,
                    ])->one();
        
                    $vaDetail->jumlah_pajak = $sppt->pbb_yg_harus_dibayar_sppt;
                    $vaDetail->denda_pajak = $sppt->denda;
        
                    $vaDetail->save();
                }
            }
        } catch (Exception $e) {
            $transaction->rollBack();

            Yii::error('ERROR1204.' . $e->getMessage() . ' | ' . $body);

            return ['result' => 'Terjadi kesalahan, coba lagi.'];
        }

        $transaction->commit();

        $result->nova = $va->no_va;

        return $result;
    }

    public function prepareSpptAkanDibayar(&$objekPajak, &$listSppt, $inputObjekPajak, $inputTahunPajak) {
        $objekPajak = ObjekPajak::find()->where([
            'kd_propinsi' => $inputObjekPajak['kd_propinsi'], 
            'kd_dati2' => $inputObjekPajak['kd_dati2'], 
            'kd_kecamatan' => $inputObjekPajak['kd_kecamatan'], 
            'kd_kelurahan' => $inputObjekPajak['kd_kelurahan'], 
            'kd_blok' => $inputObjekPajak['kd_blok'], 
            'no_urut' => $inputObjekPajak['no_urut'], 
            'kd_jns_op' => $inputObjekPajak['kd_jns_op'], 
        ])->with(['subjekPajak'])->one();

        $spptBelumDibayar = Sppt::find()->where([
            'kd_propinsi' => $inputObjekPajak['kd_propinsi'], 
            'kd_dati2' => $inputObjekPajak['kd_dati2'], 
            'kd_kecamatan' => $inputObjekPajak['kd_kecamatan'], 
            'kd_kelurahan' => $inputObjekPajak['kd_kelurahan'], 
            'kd_blok' => $inputObjekPajak['kd_blok'], 
            'no_urut' => $inputObjekPajak['no_urut'], 
            'kd_jns_op' => $inputObjekPajak['kd_jns_op'], 
            'status_pembayaran_sppt' => '0'
        ])->orderBy('thn_pajak_sppt DESC')->all();

        foreach ($spptBelumDibayar as $sppt) {
            if (in_array($sppt->thn_pajak_sppt, $inputTahunPajak)) {
                $listSppt[] = $sppt;
            }
        }
    }

    /**
     * Find ObjekPajak Model.
     */
    protected function findModel($kd_propinsi, $kd_dati2, $kd_kecamatan, $kd_kelurahan, $kd_blok, $no_urut, $kd_jns_op)
    {
        if (($model = ObjekPajak::findOne(['kd_propinsi' => $kd_propinsi, 'kd_dati2' => $kd_dati2, 'kd_kecamatan' => $kd_kecamatan, 'kd_kelurahan' => $kd_kelurahan, 'kd_blok' => $kd_blok, 'no_urut' => $no_urut, 'kd_jns_op' => $kd_jns_op])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCetakSppt($nop, $thn_pajak_sppt){

        set_time_limit(500);

        $reportFile = Yii::$app->basePath . '/reports/CetakSppt.jasper';
        $params = ['nop' => $nop, 'thn_pajak_sppt' => $thn_pajak_sppt];
        $fileName = 'SPPT_' . $nop . '_' . $thn_pajak_sppt;


        $this->download($reportFile, $params, $fileName, false);

    }
}
