<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->raza, 'nombre')->textInput() ?>

    <?= $form->field($model->especie, 'nombre')->textInput() ?>

    <?= $form->field($model, 'chip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
