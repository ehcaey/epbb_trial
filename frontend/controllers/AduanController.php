<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Aduan;
use frontend\models\AduanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\BalasanAduan;
use frontend\models\AttachmentAduan;
use common\models\User;
use Exception;
use kartik\form\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

/**
 * AduanController implements the CRUD actions for Aduan model.
 */
class AduanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update'],
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
     * Lists all Aduan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AduanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aduan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Aduan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aduan();
        $modelBalasan = new BalasanAduan();
        $modelAttach = new AttachmentAduan();
        $modelUser = User::findIdentity(Yii::$app->user->getId());

        if ($model->load(Yii::$app->request->post()) && $modelBalasan->load(Yii::$app->request->post()) && $modelAttach->load(Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();

            try{

                $model->status = Aduan::STATUS_DEFAULT;

                if(! $model->save()){
                    Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat menyimpan Aduan.');

                    return $this->redirect(['index']);
                }

                $modelBalasan->id_aduan = $model->getId();
                $modelBalasan->tipe_user = BalasanAduan::TIPE_STATUS;

                if(! $modelBalasan->save()){
                    $transaction->rollBack();

                    Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat Balasan Aduan.');

                    return $this->redirect(['index']);
                }

                // var_dump($modelAttach->file_name);die;

                if($modelAttach->file_name != null){

                    $modelAttach->id_balasan = $modelBalasan->getId();
                    
                    $modelAttach->file_name = UploadedFile::getInstance($modelAttach, 'file_name');
                    $modelAttach->file_name->name = Inflector::slug($modelUser->username) . '-' . time() . '.' . $modelAttach->file_name->extension;
                    $modelAttach->file_name->saveAs(Yii::getAlias('@uploadedPengaduanFilesPath') . '/' . $modelAttach->file_name->name);
                    $newName = Inflector::slug($modelUser->username) . '-' . time() . '.' . $modelAttach->file_name->extension;

                    $modelAttach->file_name = $newName;
                    if(! $modelAttach->save()){
                        $transaction->rollBack();

                        Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat Attach Aduan.');

                        return $this->redirect(['index']);
                    }

                }

            }catch(Exception $e){

                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Pengaduan gagal disimpan: ' . $e->getMessage());

                return $this->redirect(['index']);

            }

            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Pengaduan berhasil disimpan.');

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'modelBalasan' => $modelBalasan,
            'modelAttach' => $modelAttach,
            'modelUser' => $modelUser
        ]);
    }

    /**
     * Updates an existing Aduan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelBalasan = new BalasanAduan();
        $modelAttach = new AttachmentAduan();
        $modelUser = User::findIdentity(Yii::$app->user->getId());
        $dataBalasan = (new \yii\db\Query())
                    ->select(['a.id', 'a.isi', 'a.createdtime', 'a.tipe_user', 'b.nama', 'c.file_name', 'c.id as id_attach'])
                    ->from('epbb.balasan_aduan a')
                    ->leftJoin('epbb.user b', 'a.createdby = b.id')
                    ->leftJoin('epbb.attachment_aduan c', 'a.id = c.id_balasan')
                    ->leftJoin('pbb.users d', 'a.createdby = d.id')
                    ->where('a.id_aduan=:id', ['id' => $id])
                    ->orderBy('a.createdtime asc')
                    ->all();
        // $dataBalasan = BalasanAduan::find()->where("id_aduan = " . $id)->all();
        // var_dump($dataBalasan);die;

        if ($model->load(Yii::$app->request->post()) && $modelBalasan->load(Yii::$app->request->post()) && $modelAttach->load(Yii::$app->request->post())) {

            $transaction = Yii::$app->db->beginTransaction();

            try{

                $modelBalasan->id_aduan = $model->getId();
                $modelBalasan->tipe_user = BalasanAduan::TIPE_STATUS;

                if(! $modelBalasan->save()){
                    $transaction->rollBack();

                    Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat Balasan Aduan.');

                    return $this->redirect(['index']);
                }

                if($modelAttach->file_name != null){

                    $modelAttach->id_balasan = $modelBalasan->getId();
                    
                    $modelAttach->file_name = UploadedFile::getInstance($modelAttach, 'file_name');
                    $modelAttach->file_name->name = Inflector::slug($modelUser->username) . '-' . time() . '.' . $modelAttach->file_name->extension;
                    $modelAttach->file_name->saveAs(Yii::getAlias('@uploadedPengaduanFilesPath') . '/' . $modelAttach->file_name->name);
                    $newName = Inflector::slug($modelUser->username) . '-' . time() . '.' . $modelAttach->file_name->extension;

                    $modelAttach->file_name = $newName;
                    if(! $modelAttach->save()){
                        $transaction->rollBack();

                        Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat Attach Aduan.');

                        return $this->redirect(['index']);
                    }
                
                }

            }catch(Exception $e){

                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Pengaduan gagal disimpan: ' . $e->getMessage());

                return $this->redirect(['index']);

            }

            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Pengaduan berhasil disimpan.');

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'modelBalasan' => $modelBalasan,
            'modelAttach' => $modelAttach,
            'modelUser' => $modelUser,
            'dataBalasan' => $dataBalasan
        ]);
    }

    /**
     * Deletes an existing Aduan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aduan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aduan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aduan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownloadLampiran($id)
    {
        $file = AttachmentAduan::findOne($id);

        $filePath = Yii::getAlias('@uploadedPengaduanFilesPath/' . $file->file_name);

        return Yii::$app->response->sendFile($filePath, $file->file_name);
    }
}
