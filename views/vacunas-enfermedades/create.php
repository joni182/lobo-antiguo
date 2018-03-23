<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VacunasEnfermedades */

$this->title = 'Create Vacunas Enfermedades';
$this->params['breadcrumbs'][] = ['label' => 'Vacunas Enfermedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacunas-enfermedades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
