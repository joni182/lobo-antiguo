<?php

namespace app\controllers;

use Yii;
use app\models\EnfermedadesAnimales;
use app\models\EnfermedadesAnimalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnfermedadesAnimalesController implements the CRUD actions for EnfermedadesAnimales model.
 */
class EnfermedadesAnimalesController extends Controller
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
     * Lists all EnfermedadesAnimales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnfermedadesAnimalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EnfermedadesAnimales model.
     * @param integer $animal_id
     * @param integer $enfermedad_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($animal_id, $enfermedad_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($animal_id, $enfermedad_id),
        ]);
    }

    /**
     * Creates a new EnfermedadesAnimales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EnfermedadesAnimales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'animal_id' => $model->animal_id, 'enfermedad_id' => $model->enfermedad_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EnfermedadesAnimales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $animal_id
     * @param integer $enfermedad_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($animal_id, $enfermedad_id)
    {
        $model = $this->findModel($animal_id, $enfermedad_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'animal_id' => $model->animal_id, 'enfermedad_id' => $model->enfermedad_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EnfermedadesAnimales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $animal_id
     * @param integer $enfermedad_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($animal_id, $enfermedad_id)
    {
        $this->findModel($animal_id, $enfermedad_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EnfermedadesAnimales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $animal_id
     * @param integer $enfermedad_id
     * @return EnfermedadesAnimales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($animal_id, $enfermedad_id)
    {
        if (($model = EnfermedadesAnimales::findOne(['animal_id' => $animal_id, 'enfermedad_id' => $enfermedad_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
