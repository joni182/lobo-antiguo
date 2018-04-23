<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de BORRAR a '.$model->nombre.' de la base de datos?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <?php $rutasImagenes =  $model->getRutasImagenes()?>
        <div class="col-md-6">
            <?= Html::img($rutasImagenes[0], ['style' => [
                'border-radius' => '2%'
                ]])  ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nombre',
                    'raza.nombre:text:Raza',
                    'especie.nombre:text:Especie',
                    'peso:weight',
                    'sexo',
                    'chip',
                    'ppp:boolean:PPP',
                    'observaciones:ntext',
                    'created_at:datetime',
                ],
            ]) ?>
        </div>

    </div>
    <div class="row" style='border:solid;margin-top:20px;border-color:#dddddd;background-color:#f9f9f9'>
        <?php foreach ($rutasImagenes as $ruta): ?>
                <?= Html::img($ruta,['style' => [
                    'width' => '20%',
                    'margin' => '8px',
                    'border-radius' => '2%'
                    ]])  ?>
        <?php endforeach; ?>
    </div>
    <?php $form = ActiveForm::begin(
        [
            'action' => Url::to(['animales/agregar-imagenes','id' => $model->id]),
            'options' => [
                'enctype' => 'multipart/form-data'
                ]
            ]
        ); ?>


        <div style="margin:20px">

    <?= $form
        ->field($model, 'fotos[]')
        ->fileInput(['multiple' => true, 'accept' => 'image/*'])
        ->label('Agregar nuevas fotos') ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar imagenes', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>
