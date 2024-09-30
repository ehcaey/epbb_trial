<?php

namespace frontend\controllers;

use Carbon\Carbon;
use Exception;
use frontend\models\AttachmentPermohonan;
use frontend\models\LookupItem;
use frontend\models\MaxUrutPst;
use frontend\models\ObjekPajak;
use frontend\models\ObjekPajakSearch;
use frontend\models\PstDataObjekPajakBaru;
use frontend\models\PstDetail;
use frontend\models\PstLampiran;
use frontend\models\PstPermohonan;
use frontend\models\PstPermohonanPengurangan;
use frontend\models\PstPermohonanSearch;
use frontend\models\Referensi\JenisPelayanan;
use frontend\models\Sppt;
use frontend\models\TempDataObjekPajak;
use kartik\form\ActiveForm;
use Yii;
use yii\helpers\Inflector;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class PermohonanController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create'],
                'rules' => [
                    [
                        'actions' => ['index', 'create'],
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

    public function actionIndex()
    {
        $searchModel = new PstPermohonanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        // redirect ke data wajib pajak
        if (Yii::$app->user->identity->subjekPajak == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl("subjek-pajak/index"));
        }
        
        $modelPermohonan = new PstPermohonan();
        $modelPermohonanDetail = new PstDetail();
        $modelPermohonanLampiran = new PstLampiran();
        $modelPermohonanPengurangan = new PstPermohonanPengurangan();
        $modelDataObjekPajakBaru = new PstDataObjekPajakBaru();
        $modelAttachmentPermohonan = new AttachmentPermohonan();

        // redirect ke data wajib pajak
        if (Yii::$app->user->identity->subjekPajak == null) {
            return $this->redirect(Yii::$app->urlManager->createUrl("subjek-pajak/index"));
        }

        $modelPermohonan->nama_pemohon = Yii::$app->user->identity->subjekPajak->nm_wp;
        $modelPermohonan->alamat_pemohon = Yii::$app->user->identity->subjekPajak->jalan_wp;

 
        if ($modelPermohonan->load(Yii::$app->request->post()) && $modelPermohonanDetail->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();

            $kodeKanwil = Yii::$app->params['kd_kanwil'];
            $kodeKantor = Yii::$app->params['kd_kantor'];
            $tahunPelayanan = Carbon::now()->format('Y');

            try {
                $maxUrut = MaxUrutPst::find()->where([
                    'kd_kanwil' => $kodeKanwil,
                    'kd_kantor' => $kodeKantor,
                    'thn_pelayanan' => $tahunPelayanan
                ])->one();

                if ($maxUrut === null) {
                    $modelMaxUrut = new MaxUrutPst();
                    
                    $modelMaxUrut->kd_kanwil = $kodeKanwil;
                    $modelMaxUrut->kd_kantor = $kodeKantor;
                    $modelMaxUrut->thn_pelayanan = $tahunPelayanan;
                    $modelMaxUrut->bundel_pelayanan = '0001';
                    $modelMaxUrut->no_urut_pelayanan = '001';

                    if (! $modelMaxUrut->save()) {
                        throw new Exception('Nomor urut gagal dibuat.');
                    }

                    $noBundle = $modelMaxUrut->bundel_pelayanan;
                    $noUrut = $modelMaxUrut->no_urut_pelayanan;
                } else {
                    if ((int) $maxUrut->no_urut_pelayanan + 1 > 200) {
                        $noBundle = str_pad((int) $maxUrut->bundel_pelayanan + 1, 4, '0', STR_PAD_LEFT);
                        $noUrut = '001';
                    } else {
                        $noBundle = $maxUrut->bundel_pelayanan;
                        $noUrut = str_pad((int) $maxUrut->no_urut_pelayanan + 1, 3, '0', STR_PAD_LEFT);
                    }

                    $maxUrut->bundel_pelayanan = $noBundle;
                    $maxUrut->no_urut_pelayanan = $noUrut;

                    if (! $maxUrut->save()) {
                        throw new Exception('Nomor urut gagal diperbarui.');
                    }
                }

                $modelPermohonan->kd_kanwil = $kodeKanwil;
                $modelPermohonan->kd_kantor = $kodeKantor;
                $modelPermohonan->thn_pelayanan = $tahunPelayanan;
                $modelPermohonan->bundel_pelayanan = $noBundle;
                $modelPermohonan->no_urut_pelayanan = $noUrut;
                $modelPermohonan->nip_penerima = Yii::$app->params['nip_penerima'];
                $modelPermohonan->status = 1;
                $modelPermohonan->status_hapus = 0;
                $modelPermohonan->tgl_terima_dokumen_wp = Carbon::now()->format('Y-m-d');
                $modelPermohonan->tgl_perkiraan_selesai = Carbon::now()->addDays(7)->format('Y-m-d');
                $modelPermohonan->epbb_user_id = Yii::$app->user->id;
                
                if (! $modelPermohonan->save()) {
                    throw new Exception('Permohonan gagal disimpan.');
                }

                $modelPermohonanLampiran->kd_kanwil = $kodeKanwil;
                $modelPermohonanLampiran->kd_kantor = $kodeKantor;
                $modelPermohonanLampiran->thn_pelayanan = $modelPermohonan->thn_pelayanan;
                $modelPermohonanLampiran->bundel_pelayanan = $modelPermohonan->bundel_pelayanan;
                $modelPermohonanLampiran->no_urut_pelayanan = $modelPermohonan->no_urut_pelayanan;

                if (! $modelPermohonanLampiran->save()) {
                    throw new Exception('Lampiran permohonan gagal disimpan.');
                }

                $statusSelesai = ($modelPermohonanDetail->thn_pajak_permohonan > $modelPermohonan->thn_pelayanan) ? '2' : '1';

                if ($modelPermohonan->status_kolektif == '0') {
                    $modelPermohonanDetail->kd_kanwil = $kodeKanwil;
                    $modelPermohonanDetail->kd_kantor = $kodeKantor;
                    $modelPermohonanDetail->thn_pelayanan = $modelPermohonan->thn_pelayanan;
                    $modelPermohonanDetail->bundel_pelayanan = $modelPermohonan->bundel_pelayanan;
                    $modelPermohonanDetail->no_urut_pelayanan = $modelPermohonan->no_urut_pelayanan;
                    $modelPermohonanDetail->status_selesai = $statusSelesai;
                    $modelPermohonanDetail->tgl_selesai = Carbon::now()->format('Y-m-d');
                    $modelPermohonanDetail->kd_seksi_berkas = Yii::$app->params['kd_seksi_berkas'];
                    
                    if (! $modelPermohonanDetail->save()) {
                        throw new Exception('Detail permohonan gagal disimpan.');
                    }

                    if ($modelPermohonanDetail->kd_jns_pelayanan == '01') {
                        $modelDataObjekPajakBaru->load(Yii::$app->request->post());

                        $modelDataObjekPajakBaru->kd_kanwil = $kodeKanwil;
                        $modelDataObjekPajakBaru->kd_kantor = $kodeKantor;
                        $modelDataObjekPajakBaru->thn_pelayanan = $modelPermohonan->thn_pelayanan;
                        $modelDataObjekPajakBaru->bundel_pelayanan = $modelPermohonan->bundel_pelayanan;
                        $modelDataObjekPajakBaru->no_urut_pelayanan = $modelPermohonan->no_urut_pelayanan;
                        $modelDataObjekPajakBaru->kd_propinsi_pemohon = $modelPermohonanDetail->kd_propinsi_pemohon;
                        $modelDataObjekPajakBaru->kd_dati2_pemohon = $modelPermohonanDetail->kd_dati2_pemohon;
                        $modelDataObjekPajakBaru->kd_kecamatan_pemohon = $modelPermohonanDetail->kd_kecamatan_pemohon;
                        $modelDataObjekPajakBaru->kd_kelurahan_pemohon = $modelPermohonanDetail->kd_kelurahan_pemohon;
                        $modelDataObjekPajakBaru->kd_blok_pemohon = $modelPermohonanDetail->kd_blok_pemohon;
                        $modelDataObjekPajakBaru->no_urut_pemohon = $modelPermohonanDetail->no_urut_pemohon;
                        $modelDataObjekPajakBaru->kd_jns_op_pemohon = $modelPermohonanDetail->kd_jns_op_pemohon;
                        $modelDataObjekPajakBaru->nama_wp_baru = ($modelPermohonan->nama_pemohon == '' || $modelPermohonan->nama_pemohon == null ? 'WAJIB PAJAK' : $modelPermohonan->nama_pemohon);
                        
                        if (! $modelDataObjekPajakBaru->save()) {
                            throw new Exception('Data objek pajak baru gagal disimpan.');
                        }
                    } else if (in_array($modelPermohonanDetail->kd_jns_pelayanan, ['08', '10'])) {
                        $modelPermohonanPengurangan->load(Yii::$app->request->post());

                        $modelPermohonanPengurangan->kd_kanwil = $kodeKanwil;
                        $modelPermohonanPengurangan->kd_kantor = $kodeKantor;
                        $modelPermohonanPengurangan->thn_pelayanan = $modelPermohonan->thn_pelayanan;
                        $modelPermohonanPengurangan->bundel_pelayanan = $modelPermohonan->bundel_pelayanan;
                        $modelPermohonanPengurangan->no_urut_pelayanan = $modelPermohonan->no_urut_pelayanan;
                        $modelPermohonanPengurangan->kd_propinsi_pemohon = $modelPermohonanDetail->kd_propinsi_pemohon;
                        $modelPermohonanPengurangan->kd_dati2_pemohon = $modelPermohonanDetail->kd_dati2;
                        $modelPermohonanPengurangan->kd_kecamatan_pemohon = $modelPermohonanDetail->kd_kecamatan;
                        $modelPermohonanPengurangan->kd_kelurahan_pemohon = $modelPermohonanDetail->kd_kelurahan;
                        $modelPermohonanPengurangan->kd_blok_pemohon = $modelPermohonanDetail->kd_blok;
                        $modelPermohonanPengurangan->no_urut_pemohon = $modelPermohonanDetail->no_urut;
                        $modelPermohonanPengurangan->kd_jns_op_pemohon = $modelPermohonanDetail->kd_jns_op;
                        
                        $modelPermohonanPengurangan->jns_pengurangan = ($modelPermohonanPengurangan->jns_pengurangan == '' || $modelPermohonanPengurangan->jns_pengurangan == null) ? '2' : $modelPermohonanPengurangan->jns_pengurangan;
                        $modelPermohonanPengurangan->pct_permohonan_pengurangan = ($modelPermohonanPengurangan->pct_permohonan_pengurangan == '' || $modelPermohonanPengurangan->pct_permohonan_pengurangan == null) ? '2' : $modelPermohonanPengurangan->pct_permohonan_pengurangan;
                        
                        if (! $modelPermohonanPengurangan->save()) {
                            throw new Exception('Permohonan pengurangan gagal disimpan.');
                        }
                    } 
                    
                    if (in_array($modelPermohonanDetail->kd_jns_pelayanan, ['03', '04', '06', '07', '08', '10', '14'])) {
                        $jenisData = '';

                        if (in_array($modelPermohonanDetail->kd_jns_pelayanan, ['06', '07', '14'])) {
                            $jenisData = '0';
                        } else if ($modelPermohonanDetail->kd_jns_pelayanan == '03') {
                            $jenisData = '1';
                        } else if (in_array($modelPermohonanDetail->kd_jns_pelayanan, ['08', '10'])) {
                            $jenisData = '2';
                        } else {
                            $jenisData = '3';
                        }

                        $objekPajak = ObjekPajak::find()->where([
                            'kd_propinsi' => $modelPermohonanDetail->kd_propinsi_pemohon, 
                            'kd_dati2' => $modelPermohonanDetail->kd_dati2_pemohon, 
                            'kd_kecamatan' => $modelPermohonanDetail->kd_kecamatan_pemohon, 
                            'kd_kelurahan' => $modelPermohonanDetail->kd_kelurahan_pemohon, 
                            'kd_blok' => $modelPermohonanDetail->kd_blok_pemohon, 
                            'no_urut' => $modelPermohonanDetail->no_urut_pemohon, 
                            'kd_jns_op' => $modelPermohonanDetail->kd_jns_op_pemohon,
                        ])->one();

                        $sppt = Sppt::find()->where([
                            'kd_propinsi' => $modelPermohonanDetail->kd_propinsi_pemohon, 
                            'kd_dati2' => $modelPermohonanDetail->kd_dati2_pemohon, 
                            'kd_kecamatan' => $modelPermohonanDetail->kd_kecamatan_pemohon, 
                            'kd_kelurahan' => $modelPermohonanDetail->kd_kelurahan_pemohon, 
                            'kd_blok' => $modelPermohonanDetail->kd_blok_pemohon, 
                            'no_urut' => $modelPermohonanDetail->no_urut_pemohon, 
                            'kd_jns_op' => $modelPermohonanDetail->kd_jns_op_pemohon,
                            'thn_pajak_sppt' => $modelPermohonanDetail->thn_pajak_permohonan,
                        ])->one();

                        $modelTempDataObjekPajak = new TempDataObjekPajak();

                        $modelTempDataObjekPajak->kd_kanwil = $kodeKanwil;
                        $modelTempDataObjekPajak->kd_kantor = $kodeKantor;
                        $modelTempDataObjekPajak->thn_pelayanan = $modelPermohonan->thn_pelayanan;
                        $modelTempDataObjekPajak->bundel_pelayanan = $modelPermohonan->bundel_pelayanan;
                        $modelTempDataObjekPajak->no_urut_pelayanan = $modelPermohonan->no_urut_pelayanan;
                        $modelTempDataObjekPajak->kd_propinsi_pemohon = $modelPermohonanDetail->kd_propinsi_pemohon;
                        $modelTempDataObjekPajak->kd_dati2_pemohon = $modelPermohonanDetail->kd_dati2_pemohon;
                        $modelTempDataObjekPajak->kd_kecamatan_pemohon = $modelPermohonanDetail->kd_kecamatan_pemohon;
                        $modelTempDataObjekPajak->kd_kelurahan_pemohon = $modelPermohonanDetail->kd_kelurahan_pemohon;
                        $modelTempDataObjekPajak->kd_blok_pemohon = $modelPermohonanDetail->kd_blok_pemohon;
                        $modelTempDataObjekPajak->no_urut_pemohon = $modelPermohonanDetail->no_urut_pemohon;
                        $modelTempDataObjekPajak->kd_jns_op_pemohon = $modelPermohonanDetail->kd_jns_op_pemohon;
                        $modelTempDataObjekPajak->temp_jns_data = $jenisData;
                        $modelTempDataObjekPajak->temp_siklus_sppt = $sppt->siklus_sppt;
                        $modelTempDataObjekPajak->temp_nm_wp = $sppt->nm_wp_sppt;
                        $modelTempDataObjekPajak->temp_jalan_op = $objekPajak->jalan_op;
                        $modelTempDataObjekPajak->temp_blok_kav_no_op = $objekPajak->blok_kav_no_op;
                        $modelTempDataObjekPajak->temp_rw_op = $objekPajak->rw_op;
                        $modelTempDataObjekPajak->temp_rt_wp = $objekPajak->rt_op;
                        $modelTempDataObjekPajak->temp_jalan_wp = $sppt->jln_wp_sppt;
                        $modelTempDataObjekPajak->temp_blok_kav_no_wp = $sppt->blok_kav_no_wp_sppt;
                        $modelTempDataObjekPajak->temp_rw_wp = $sppt->rw_wp_sppt;
                        $modelTempDataObjekPajak->temp_rt_wp = $sppt->rt_wp_sppt;
                        $modelTempDataObjekPajak->temp_kelurahan_wp = $sppt->kelurahan_wp_sppt;
                        $modelTempDataObjekPajak->temp_kota_wp = $sppt->kota_wp_sppt;
                        $modelTempDataObjekPajak->temp_kd_pos_wp = $sppt->kd_pos_wp_sppt;
                        $modelTempDataObjekPajak->temp_npwp = $sppt->npwp_sppt;
                        $modelTempDataObjekPajak->temp_subjek_pajak_id = $objekPajak->subjek_pajak_id;
                        $modelTempDataObjekPajak->kd_kls_tanah = $sppt->kd_kls_tanah;
                        $modelTempDataObjekPajak->thn_awal_kls_tanah = $sppt->thn_awal_kls_tanah;
                        $modelTempDataObjekPajak->kd_kls_bng = $sppt->kd_kls_bng;
                        $modelTempDataObjekPajak->thn_awal_kls_bng = $sppt->thn_awal_kls_bng;
                        $modelTempDataObjekPajak->temp_luas_bumi = $sppt->luas_bumi_sppt;
                        $modelTempDataObjekPajak->temp_luas_bangunan = $sppt->luas_bng_sppt;
                        $modelTempDataObjekPajak->temp_njop_bumi = $sppt->njop_bumi_sppt;
                        $modelTempDataObjekPajak->temp_njop_bangunan = $sppt->njop_bng_sppt;
                        $modelTempDataObjekPajak->temp_njop = $sppt->njop_sppt;
                        $modelTempDataObjekPajak->temp_njoptkp = $sppt->njoptkp_sppt;
                        $modelTempDataObjekPajak->temp_pbb_terhutang = $sppt->pbb_terhutang_sppt;
                        $modelTempDataObjekPajak->temp_besar_denda = "0"; 
                        $modelTempDataObjekPajak->temp_faktor_pengurang = $sppt->faktor_pengurang_sppt;
                        $modelTempDataObjekPajak->temp_pbb_yg_harus_dibayar = $sppt->pbb_yg_harus_dibayar_sppt;
                        $modelTempDataObjekPajak->temp_tgl_jatuh_tempo = $sppt->tgl_jatuh_tempo_sppt;

                        if (! $modelTempDataObjekPajak->save()) {
                            throw new Exception('Temporary data objek pajak gagal disimpan.');
                        }
                    }
                }

                $attachments = Yii::$app->request->post('AttachmentPermohonan');

                foreach ($attachments as $key => $item) {
                    $attachmentPermohonan = new AttachmentPermohonan();

                    $attachmentPermohonan->thn_pelayanan = $modelPermohonan->thn_pelayanan;
                    $attachmentPermohonan->bundel_pelayanan = $modelPermohonan->bundel_pelayanan;
                    $attachmentPermohonan->no_urut_pelayanan = $modelPermohonan->no_urut_pelayanan;
                    $attachmentPermohonan->jenis_lampiran = $key;
                    $attachmentPermohonan->file_name = UploadedFile::getInstance($attachmentPermohonan, $key);
                    
                    if ($attachmentPermohonan->file_name != null) {
                        $attachmentPermohonan->file_name->name = Inflector::slug($attachmentPermohonan->file_name->name) . '-' . time() . '.' . $attachmentPermohonan->file_name->extension;
                        
                        if (! $attachmentPermohonan->save()) {
                            throw new Exception('Lampiran gagal disimpan.');
                        }
                        
                        $attachmentPermohonan->file_name->saveAs(Yii::getAlias('@uploadedLampiranPermohonanFilesPath') . '/' . $attachmentPermohonan->file_name);
                        
                        $modelPermohonanLampiran->setAttribute($key, 1);
                    }
                }

                $modelPermohonanLampiran->save();
            } catch (Exception $e) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('error', $e->getMessage());

                return $this->redirect(['create']);
            }

            $transaction->commit();

            return $this->redirect(['index']);
        }

        $statusKolektifList = LookupItem::find()->where(['kd_lookup_group' => '03'])->orderBy('kd_lookup_item', 'ASC')->all();
        $jenisPelayananList = JenisPelayanan::find()->all();
        $jenisPenguranganList = LookupItem::find()->where(['kd_lookup_group' => "77"])->orderBy('kd_lookup_item', 'ASC')->all();

        $modelPermohonan->tgl_surat_permohonan = Carbon::now()->format('Y-m-d');

        return $this->render('create', compact(
            'modelPermohonan',
            'modelPermohonanDetail',
            'modelPermohonanLampiran',
            'modelPermohonanPengurangan',
            'modelAttachmentPermohonan',
            'modelDataObjekPajakBaru',
            'statusKolektifList',
            'jenisPelayananList',
            'jenisPenguranganList'
        ));
    }

    public function actionLookupObjekPajak() 
    {
        $searchModel = new ObjekPajakSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('_lookup_op', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDownloadLampiran($id)
    {
        $file = AttachmentPermohonan::findOne($id);

        $filePath = Yii::getAlias('@uploadedLampiranPermohonanFilesPath/' . $file->file_name);

        return Yii::$app->response->sendFile($filePath, $file->file_name);
    }
}
