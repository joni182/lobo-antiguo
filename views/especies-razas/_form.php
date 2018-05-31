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

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($razaModel, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($razaModel, 'especie_id')
        ->dropDownList(Especies::nombres())
        ->label('Especie')
    ?>
    <?= Html::a('Añadir Especie', Url::to(['especies/create']), ['class' => 'btn btn-info']) ?>

    <br><br>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
