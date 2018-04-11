<?php

namespace app\controllers;

use app\models\Especies;
use app\models\EspeciesSearch;
use app\models\Razas;
use app\models\RazasSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RazasController implements the CRUD actions for Razas model.
 */
class EspeciesRazasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionDropDownListAjax()
    {
        $this->layout = false;

        $razaModel = new Razas();
        if (Yii::$app->request->isAjax) {
            return $this->render('_dropdown', [
                'razaModel' => $razaModel,
            ]);
        }
    }

    /**
     * Lists all Razas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $razaModel = new Razas();
        $especieModel = new Especies();
        $razaSearchModel = new RazasSearch();
        $especieSearchModel = new EspeciesSearch();
        $razaDataProvider = $razaSearchModel->search(Yii::$app->request->queryParams);
        $especieDataProvider = $especieSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'razaModel' => $razaModel,
            'especieModel' => $especieModel,
            'razaSearchModel' => $razaSearchModel,
            'especieSearchModel' => $especieSearchModel,
            'razaDataProvider' => $razaDataProvider,
            'especieDataProvider' => $especieDataProvider,
        ]);
    }

    public function actionNombresAjax($especie_id)
    {
        if (Yii::$app->request->isAjax) {
            return json_encode(Razas::nombres($especie_id));
        }
    }

    /**
     * Creates a new Razas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $razaModel = new Razas();
        $especieModel = new Especies();

        if ($razaModel->load(Yii::$app->request->post()) && $razaModel->save()) {
            return $this->redirect(['view', 'id' => $razaModel->id]);
        }

        return $this->render('create', [
            'razaModel' => $razaModel,
        ]);
    }

    /**
     * Updates an existing Razas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Razas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
