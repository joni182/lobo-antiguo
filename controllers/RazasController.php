<?php

namespace app\controllers;

use app\models\Razas;
use app\models\RazasSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RazasController implements the CRUD actions for Razas model.
 */
class RazasController extends Controller
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

    /**
     * Lists all Razas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RazasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Razas model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $this->layout = false;
        $model = new Razas();
        $searchModel = new RazasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('index', [
                 'searchModel' => $searchModel,
                 'dataProvider' => $dataProvider,
             ]);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('index', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
    }

    /**
     * Updates an existing Razas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Razas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (count($model->animales) == 0) {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', "Se ha borrado la raza {$model->nombre}.");
            } else {
                Yii::$app->session->setFlash('error', "No se ha podido borrar la raza {$model->nombre}.");
            }
        } else {
            Yii::$app->session->setFlash('error', "No se ha podido borrar la raza {$model->nombre}, hay animales que dependen de esta especie.");
        }


        return $this->redirect(['/especies-razas/index']);
    }

    /**
     * Finds the Razas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Razas the loaded model
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
