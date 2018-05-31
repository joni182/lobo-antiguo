<?php

use app\models\Razas;
use app\models\Especies;
use app\models\Animales;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */
/* @var $form yii\widgets\ActiveForm */


$url = Url::to(['razas/nombres-ajax']);
$js = <<<EOT
    function peticion(){
        $('#animales-razas').empty();
        $.get('$url',  {'especie_id': $('#especie').children().eq($('#especie').prop('selectedIndex')).attr('value'),'animal_id': '{$model->id}', 'origen': '_form'}).done(function(data) {
            $('#animales-razas').html(data);
        }).fail(function() {
            $('#animales-razas').html('<h2>Ha habido algún error en el servidor y no se puede recuperar el listado de razas</h2>');
        });
    };
    $(document).ready(function(){
        $('select[name="especie"]').on('change', peticion);
        $('select[name="especie"]').attr('id','especie');
        peticion();
    });
EOT;

$this->registerJs($js);
?>

<div class="animales-form">

    <?php $form = ActiveForm::begin(
        [
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]);

        $opcionSeleccionar = ['' => ''];

    ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sexo')
        ->dropDownList(array_merge($opcionSeleccionar, Animales::sexosDisponibles()))
    ?>

    <?= $form->field($model, 'tamanio')
        ->dropDownList(array_merge($opcionSeleccionar, Animales::tamaniosDisponibles()))
    ?>

    <?= $form->field($model, 'peso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppp')->checkbox() ?>

    <?= $form->field($model, 'chip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colores_rec')->checkboxList(\app\models\Colores::nombres());  ?>

    <fieldset>
        <legend>Raza</legend>
        <label>Especie
            <div class="">
                <?= Html::dropDownList('especie',
                                        isset($model->razas[0])? $model->razas[0]->especie_id: null,
                                        Especies::nombres()) ?>
            </div>
        </label>

        <div id='animales-razas' class="form-group field-animales-razas has-success" style="margin-top:15px;">
            <!-- Este DIV se rellena mediante una petición ajax al cargar la página o al cambiar la especie -->
        </div>
    </fieldset>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fotos[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
