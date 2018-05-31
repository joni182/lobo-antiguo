<?php

namespace app\controllers;

use app\models\Animales;
use app\models\AnimalesSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * AnimalesController implements the CRUD actions for Animales model.
 */
class AnimalesController extends Controller
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
     * Lists all Animales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->razas_rec = null;
        $searchModel->colores_rec = null;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Animales model.
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

    /**
     * Creates a new Animales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Animales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->asignarRazas();
            $model->asignarColores();
            if ($this->uploadImagenes($model)) {
                Yii::$app->session->setFlash('success', 'Se han agregado fotos satisfactoriamente.');
                $model->establecerFotoPrincipal($model->rutasImagenes[0]);
            } else {
                Yii::$app->session->setFlash('error', 'No se han podido agregar las fotos adecuadamente.');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Animales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->desasignarRazas();
            $model->asignarRazas();

            $model->desasignarColores();
            $model->asignarColores();

            if ($boleano = ($this->uploadImagenes($model)) !== null) {
                if ($boleano) {
                    Yii::$app->session->setFlash('success', 'Se han agregado fotos satisfactoriamente.');
                } else {
                    Yii::$app->session->setFlash('error', 'No se han podido agregar las fotos adecuadamente.');
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->colores_rec = $model->coloresAsignadosId();

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAgregarImagenes($id)
    {
        $model = $this->findModel($id);

        if ($this->uploadImagenes($model)) {
            Yii::$app->session->setFlash('success', 'Se han agregado fotos satisfactoriamente.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        Yii::$app->session->setFlash('error', 'No se han podido agregar las fotos adecuadamente.');
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Animales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBorrarImagen($id, $ruta)
    {
        if (file_exists($ruta)) {
            if (unlink($ruta)) {
                Yii::$app->session->setFlash('success', 'Se ha borrado la imagen satisfactoriamente.');
            } else {
                Yii::$pp->session->setFlash('error', 'No se ha podido borrar la imagen.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'El archivo que intenta borrar no existe.');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionCambiarPrincipal($id, $ruta)
    {
        $model = Animales::findOne($id);

        if ($model->establecerFotoPrincipal($ruta)) {
            Yii::$app->session->setFlash('success', 'Se ha cambiado la imagen satisfactoriamente.');
        } else {
            Yii::$pp->session->setFlash('error', 'No se ha podido cambiar la imagen.');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionBorrarFotoPrincipal($id)
    {
        $model = Animales::findOne($id);
        if ($model->borrarFotoPrincipal()) {
            Yii::$app->session->setFlash('success', 'Se ha borrado la foto principal');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido borrado la foto principal');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    protected function uploadImagenes($model)
    {
        if ($model->fotos = UploadedFile::getInstances($model, 'fotos')) {
            return $model->upload();
        }
    }

    /**
     * Finds the Animales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Animales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Animales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
