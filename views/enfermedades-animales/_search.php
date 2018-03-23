<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesAnimalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enfermedades-animales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'animal_id') ?>

    <?= $form->field($model, 'enfermedad_id') ?>

    <?= $form->field($model, 'fecha_inicio') ?>

    <?= $form->field($model, 'duracion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
