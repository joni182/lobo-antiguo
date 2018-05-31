<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Especies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="especies-form">

    <?php $form = ActiveForm::begin([
        'id' => 'registrar-especie',
    ]); ?>

    <?= $form->field($model, 'nombre')->label('Nueva Especie')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

    <?= Html::input('submit',null,'Guardar', [
        'id' => 'submitEspecie',
        'class' => 'btn btn-success',
        'data' => [
            'tipo' => 'especies',
        ],
    ]) ?>

</div>
