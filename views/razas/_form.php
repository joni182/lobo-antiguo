<?php

use app\models\Especies;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Razas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="razas-form">

    <?php $form = ActiveForm::begin(['id'=>'registrar-raza']) ?>
    <?= $form->field($model, 'nombre')->textInput(['maxLength' => true])->label('Nueva Raza') ?>
    <?= $form->field($model, 'especie_id')->dropDownList(Especies::nombres())->label('Especie') ?>
    <?php $form = ActiveForm::end() ?>
    <input type="submit" id="submitRaza" data-tipo="razas" value="Guardar">

</div>
