<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tratamientos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tratamientos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'medicamento_id')->textInput() ?>

    <?= $form->field($model, 'veterinario_id')->textInput() ?>

    <?= $form->field($model, 'fecha_inicio')->textInput() ?>

    <?= $form->field($model, 'duracion')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
