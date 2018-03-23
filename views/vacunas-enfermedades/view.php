<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VacunasEnfermedades */

$this->title = $model->vacuna_id;
$this->params['breadcrumbs'][] = ['label' => 'Vacunas Enfermedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacunas-enfermedades-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'vacuna_id' => $model->vacuna_id, 'enfermedad_id' => $model->enfermedad_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'vacuna_id' => $model->vacuna_id, 'enfermedad_id' => $model->enfermedad_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'vacuna_id',
            'enfermedad_id',
        ],
    ]) ?>

</div>
