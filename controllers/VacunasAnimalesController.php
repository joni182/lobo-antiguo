<?php

namespace app\controllers;

use Yii;
use app\models\VacunasAnimales;
use app\models\VacunasAnimalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VacunasAnimalesController implements the CRUD actions for VacunasAnimales model.
 */
class VacunasAnimalesController extends Controller
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
     * Lists all VacunasAnimales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacunasAnimalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VacunasAnimales model.
     * @param integer $animal_id
     * @param integer $vacuna_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($animal_id, $vacuna_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($animal_id, $vacuna_id),
        ]);
    }

    /**
     * Creates a new VacunasAnimales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VacunasAnimales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'animal_id' => $model->animal_id, 'vacuna_id' => $model->vacuna_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VacunasAnimales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $animal_id
     * @param integer $vacuna_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($animal_id, $vacuna_id)
    {
        $model = $this->findModel($animal_id, $vacuna_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'animal_id' => $model->animal_id, 'vacuna_id' => $model->vacuna_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VacunasAnimales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $animal_id
     * @param integer $vacuna_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($animal_id, $vacuna_id)
    {
        $this->findModel($animal_id, $vacuna_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VacunasAnimales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $animal_id
     * @param integer $vacuna_id
     * @return VacunasAnimales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($animal_id, $vacuna_id)
    {
        if (($model = VacunasAnimales::findOne(['animal_id' => $animal_id, 'vacuna_id' => $vacuna_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
