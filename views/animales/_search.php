<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Especies;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesSearch */
/* @var $form yii\widgets\ActiveForm */

$url = Url::to(['razas/nombres-ajax']);
$js = <<<EOT
    function peticion(){
        $('#animales-razas').empty();
        $.get('$url',  {'especie_id': $('#especie').children().eq($('#especie').prop('selectedIndex')).attr('value'), 'origen': '_search'}).done(function(data) {
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

<div class="animales-search" >

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'style' => 'display:none;',
            'class' => 'col-sm-offset-3 col-md-6 '
        ],

    ]); ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'sexo')
        ->dropDownList(
            [
                '' => '--Seleccionar--',
                'Hembra' => 'Hembra',
                'Macho' => 'Macho',
            ]
        )
    ?>

    <?= $form->field($model, 'peso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppp')->dropDownList(['' => '--Seleccionar--', false => 'No', true => 'Si']) ?>

    <?= $form->field($model, 'chip') ?>

    <?= $form->field($model, 'colores_rec[]')->checkboxList(\app\models\Colores::nombres());  ?>

    <fieldset>
        <legend>Raza</legend>
        <label>Especie
            <div class="">
                <?= Html::dropDownList('especie', null, Especies::nombres()) ?>
            </div>
        </label>

        <div id='animales-razas' class="form-group field-animales-razas has-success" style="margin-top:15px;">

        </div>
    </fieldset>

    <?php echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpiar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
