<?php

namespace app\controllers;

use Yii;
use app\models\VacunasEnfermedades;
use app\models\VacunasEnfermedadesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VacunasEnfermedadesController implements the CRUD actions for VacunasEnfermedades model.
 */
class VacunasEnfermedadesController extends Controller
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
     * Lists all VacunasEnfermedades models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacunasEnfermedadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VacunasEnfermedades model.
     * @param integer $vacuna_id
     * @param integer $enfermedad_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($vacuna_id, $enfermedad_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($vacuna_id, $enfermedad_id),
        ]);
    }

    /**
     * Creates a new VacunasEnfermedades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VacunasEnfermedades();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'vacuna_id' => $model->vacuna_id, 'enfermedad_id' => $model->enfermedad_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VacunasEnfermedades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $vacuna_id
     * @param integer $enfermedad_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($vacuna_id, $enfermedad_id)
    {
        $model = $this->findModel($vacuna_id, $enfermedad_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'vacuna_id' => $model->vacuna_id, 'enfermedad_id' => $model->enfermedad_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VacunasEnfermedades model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $vacuna_id
     * @param integer $enfermedad_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($vacuna_id, $enfermedad_id)
    {
        $this->findModel($vacuna_id, $enfermedad_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VacunasEnfermedades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $vacuna_id
     * @param integer $enfermedad_id
     * @return VacunasEnfermedades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($vacuna_id, $enfermedad_id)
    {
        if (($model = VacunasEnfermedades::findOne(['vacuna_id' => $vacuna_id, 'enfermedad_id' => $enfermedad_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
