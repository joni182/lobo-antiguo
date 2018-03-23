<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VacunasEnfermedades */

$this->title = 'Update Vacunas Enfermedades: ' . $model->vacuna_id;
$this->params['breadcrumbs'][] = ['label' => 'Vacunas Enfermedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vacuna_id, 'url' => ['view', 'vacuna_id' => $model->vacuna_id, 'enfermedad_id' => $model->enfermedad_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacunas-enfermedades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
