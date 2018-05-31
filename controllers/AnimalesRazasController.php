<?php

namespace app\controllers;

use Yii;
use app\models\AnimalesRazas;
use app\models\AnimalesRazasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnimalesRazasController implements the CRUD actions for AnimalesRazas model.
 */
class AnimalesRazasController extends Controller
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
     * Lists all AnimalesRazas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimalesRazasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnimalesRazas model.
     * @param integer $animal_id
     * @param integer $raza_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($animal_id, $raza_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($animal_id, $raza_id),
        ]);
    }

    /**
     * Creates a new AnimalesRazas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnimalesRazas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'animal_id' => $model->animal_id, 'raza_id' => $model->raza_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AnimalesRazas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $animal_id
     * @param integer $raza_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($animal_id, $raza_id)
    {
        $model = $this->findModel($animal_id, $raza_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'animal_id' => $model->animal_id, 'raza_id' => $model->raza_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AnimalesRazas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $animal_id
     * @param integer $raza_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($animal_id, $raza_id)
    {
        $this->findModel($animal_id, $raza_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnimalesRazas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $animal_id
     * @param integer $raza_id
     * @return AnimalesRazas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($animal_id, $raza_id)
    {
        if (($model = AnimalesRazas::findOne(['animal_id' => $animal_id, 'raza_id' => $raza_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
