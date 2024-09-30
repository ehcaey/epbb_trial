<?php

namespace frontend\controllers;

use frontend\models\ObjekPajak;
use frontend\models\ObjekPajakSearch;
use frontend\models\SubjekPajakSearch;
use Yii;
use frontend\traits\Jasper;
use yii\db\Expression;
use yii\httpclient\Client;
use yii\web\Controller;

/**
 * PembayaranController implements the CRUD actions for VirtualAccount model.
 */
class CekPiutangController extends Controller
{
    use Jasper;
    
    public function actionIndex()
    {
        $model = new ObjekPajakSearch();
        $this->layout = 'main-login';
        return $this->render('index', ['model' => $model]);
    }

    public function actionDetail($nop)
    {
        $this->layout = 'cek-piutang';
        $model = ObjekPajakSearch::findOne([
            'kd_propinsi' => substr($nop, 0, 2),
            'kd_dati2' => substr($nop, 2, 2),
            'kd_kecamatan' => substr($nop, 4, 3),
            'kd_kelurahan' => substr($nop, 7, 3),
            'kd_blok' => substr($nop, 10, 3),
            'no_urut' => substr($nop, 13, 4),
            'kd_jns_op' => substr($nop, 17, 1),
        ]);

        if ($model) {

            $modelSubjekPajak = SubjekPajakSearch::findOne($model->subjek_pajak_id); 

            $modelSPPT = (new \yii\db\Query())
            ->select([
                's.thn_pajak_sppt',
                's.nm_wp_sppt',
                's.pbb_yg_harus_dibayar_sppt',
                'TO_CHAR(ps.tgl_pembayaran_sppt, \'DD-MM-YYYY\') as tgl_pembayaran_sppt',
                'TO_CHAR(s.tgl_jatuh_tempo_sppt, \'DD-MM-YYYY\') as tgl_jatuh_tempo_sppt',
                's.status_pembayaran_sppt',
                new Expression('pbb.denda(tgl_jatuh_tempo_sppt::date, now()::date, pbb_yg_harus_dibayar_sppt) as denda')
            ])
            ->from('sppt s')
            ->leftJoin('pembayaran_sppt ps',
                's.kd_propinsi = ps.kd_propinsi and
                s.kd_dati2 = ps.kd_dati2 and
                s.kd_kecamatan = ps.kd_kecamatan and
                s.kd_kelurahan = ps.kd_kelurahan and
                s.kd_blok = ps.kd_blok and
                s.no_urut = ps.no_urut and
                s.kd_jns_op = ps.kd_jns_op and
                s.thn_pajak_sppt = ps.thn_pajak_sppt'
            )
            ->where([
                's.kd_propinsi' => substr($nop, 0, 2),
                's.kd_dati2' => substr($nop, 2, 2),
                's.kd_kecamatan' => substr($nop, 4, 3),
                's.kd_kelurahan' => substr($nop, 7, 3),
                's.kd_blok' => substr($nop, 10, 3),
                's.no_urut' => substr($nop, 13, 4),
                's.kd_jns_op' => substr($nop, 17, 1),
            ])
            ->orderBy(['s.thn_pajak_sppt' => SORT_DESC])
            ->all();
        
            return $this->render('detail', [
                // 'fileName' => $fileName,
                'nop' => $nop,
                'model' => $model,
                'modelSp' => $modelSubjekPajak,
                'modelSPPT' => $modelSPPT
            ]);

        }else {
            Yii::$app->getSession()->setFlash('error', 'NOP tidak ditemukan.');
        
            return $this->redirect(['index']);
        }
    }

    public function actionGenerateVa()
    {
        // Create an instance of the HTTP client
        $client = new Client();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $totalPBB = $request->post('totalPBB');
            $tahun = $request->post('tahun');
            $nop = $request->post('nop');
        }

        // Send a POST request
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('http://127.0.0.1:7315/api/pbb/qris/create') // replace with your API endpoint
            ->setData([
                'nop' => str_replace(['.','-'],'', $nop),
                'tahun' => $tahun
                // 'nop' => '640304000400000977',
                // 'tahun' => ['2022','2024','2023']
                // add more parameters as needed
            ])
            ->addHeaders([
                'Authorization' => 'Bearer 1|MnIB6mzPHoxTFfMRJdjbc8Xv5GHcBfCJZqOxEQbF8be37c4e', // replace with your actual Bearer token
            ])
            ->send();

        if ($response->isOk) {
            // Process the response if the request was successful
            $data = $response->data;
            // return $this->render('detail', compact('data'));
            return $this->asJson([
                'status' => 'success',
                'tahun' => $data['tahun'],
                'image' => $data['image']
            ]);
        } else {
            // Handle the error
            $error = $response->content;
            return $this->render('detail', ['error' => $error]);
        }
    }

}
