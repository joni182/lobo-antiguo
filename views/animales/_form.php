<?php

use app\models\Razas;
use app\models\Especies;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */
/* @var $form yii\widgets\ActiveForm */
$url = Url::to(['razas/nombres-ajax']);
$js = <<<EOT
    function formarSelect(result){
        $('#animales-raza_id').empty();
        for(key in result){;
            $('#animales-raza_id').append("<option value='"+key+"'>"+result[key]+"</option>")
        }
        if ($('#animales-raza_id').children().length == 0){
            $('#animales-raza_id').append("<option>No hay razas registradas</option>")
        }
    }
    function peticion(){
        $.getJSON('$url',  {'especie_id': $('#animales-especie_id').prop('selectedIndex')+1}, function(result){
            formarSelect(result);
        });
    };
    $(document).ready(function(){
        $('#animales-especie_id').on('change', peticion);
        peticion();
    });
EOT;

$this->registerJs($js);
?>

<div class="animales-form">

    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
        ); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sexo')
        ->dropDownList(
            [
                'Hembra' => 'Hembra',
                'Macho' => 'Macho',
            ]
        )
    ?>

    <?= $form->field($model, 'especie_id')
        ->dropDownList(Especies::nombres())
        ->label('Especie')
    ?>

    <?= $form->field($model, 'raza_id')->dropDownList([])->label('Raza') ?>

    <?= $form->field($model, 'peso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppp')->checkbox()->label('PPP ') ?>

    <?= $form->field($model, 'chip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fotos[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
