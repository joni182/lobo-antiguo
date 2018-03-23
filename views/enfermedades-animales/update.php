<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesAnimales */

$this->title = 'Update Enfermedades Animales: ' . $model->animal_id;
$this->params['breadcrumbs'][] = ['label' => 'Enfermedades Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->animal_id, 'url' => ['view', 'animal_id' => $model->animal_id, 'enfermedad_id' => $model->enfermedad_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enfermedades-animales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
