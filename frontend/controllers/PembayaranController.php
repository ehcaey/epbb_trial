<?php

namespace frontend\controllers;

use Yii;
use frontend\models\VirtualAccount;
use frontend\models\VirtualAccountDetail;
use frontend\models\VirtualAccountSearch;
use frontend\traits\Jasper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PembayaranController implements the CRUD actions for VirtualAccount model.
 */
class PembayaranController extends Controller
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
                'only' => ['index', 'create', 'view', 'bukti-pembayaran'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'view', 'bukti-pembayaran'],
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
     * Lists all VirtualAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VirtualAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VirtualAccount model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = VirtualAccount::find()->with(['details'])->where(['id' => $id])->one();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new VirtualAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VirtualAccount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the VirtualAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VirtualAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VirtualAccount::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBuktiPembayaran($nova)
    {
        $reportFile = Yii::$app->basePath . '/reports/StrukPembayaran.jasper';
        $params = ['nova' => $nova];
        $fileName = 'BUKTI_' . $nova;

        $this->download($reportFile, $params, $fileName);
    }
}
