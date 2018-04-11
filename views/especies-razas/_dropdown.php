<?php

use app\models\Especies;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Razas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registrar-razas">
    <?php $form = ActiveForm::begin(['id'=>'registrar-raza']) ?>
    <?= $form->field($razaModel, 'nombre')->textInput(['maxLength' => true])->label('Raza') ?>
    <?= $form->field($razaModel, 'especie_id')->dropDownList(Especies::nombres())->label('Especie') ?>
    <?php $form = ActiveForm::end() ?>
    <input type="submit" id="submitRaza" data-tipo="razas" value="Guardar">
</div>
