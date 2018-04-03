<?php

use yii\helpers\Html;
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'raza.nombre:text:Raza',
            'especie.nombre:text:Especie',
            'sexo',
            'chip',
            'observaciones:ntext',
            'created_at',
        ],
    ]) ?>

</div>
