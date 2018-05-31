<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesRazas */

$this->title = 'Update Animales Razas: ' . $model->animal_id;
$this->params['breadcrumbs'][] = ['label' => 'Animales Razas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->animal_id, 'url' => ['view', 'animal_id' => $model->animal_id, 'raza_id' => $model->raza_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="animales-razas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
