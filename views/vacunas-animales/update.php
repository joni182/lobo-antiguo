<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VacunasAnimales */

$this->title = 'Update Vacunas Animales: ' . $model->animal_id;
$this->params['breadcrumbs'][] = ['label' => 'Vacunas Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->animal_id, 'url' => ['view', 'animal_id' => $model->animal_id, 'vacuna_id' => $model->vacuna_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacunas-animales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
