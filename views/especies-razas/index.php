<?php

use app\models\Especies;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\models\RazasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$urlEspeciesCreate= '"'.Url::to(['especies/create']).'"';
$urlEspeciesIndex= '"'.Url::to(['especies/index']).'"';
$urlRazasCreate= '"'.Url::to(['razas/create']).'"';
$urlRazasIndex= '"'.Url::to(['razas/index']).'"';
$urlEspeciesNombres = '"'.Url::to(['especies/nombres-ajax']).'"';
$urlDropDown = '"'.Url::to(['especies-razas/drop-down-list-ajax']).'"';

$js = <<<JS

    function guardar(e){
        e.preventDefault()
        console.log('hola')
        let create;
        let index;
        let form;
        let especiesORazas = $(this).data('tipo');
        if ( especiesORazas  == 'especies' ){
            form = $('#registrar-especie')
            create = $urlEspeciesCreate;
            index = $urlEspeciesIndex;
        }else {
            form = $('#registrar-raza')
            create = $urlRazasCreate;
            index = $urlRazasIndex;
        }

        $.ajax(
            {
                type: 'POST',
                url: create,
                data: form.serialize(),
                success: function(data){
                    $(".visualizar-"+especiesORazas).empty();
                    $(".visualizar-"+especiesORazas).html(data);
                    if(especiesORazas == "especies"){
                        $.getJSON($urlEspeciesNombres,function(objeto){
                            $('#razas-especie_id').empty();
                            for (especie in objeto){
                                $('#razas-especie_id').append("<option value="+especie+">"+objeto[especie]+"</option>");
                            };
                            $('#razas-especie_id').children().last().attr("selected",true);
                        })
                    };
                },
            }
        );
    }
    $('input[type=submit]').on('click', guardar);
JS;

$this->registerJs($js);

$this->title = 'Especies y Razas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="especies-razas">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h2>Especies</h2>
    <div class="row justify-content-md-center">
        <div class="registrar-especies">
            <div class="col-md-4">
                <?php $form = ActiveForm::begin(['id'=>'registrar-especie']) ?>
                <?= $form->field($especieModel, 'nombre')->textInput(['maxLength' => true])->label('Especie') ?>
                <?php $form = ActiveForm::end() ?>
                <input type="submit" id="submitEspecie" data-tipo="especies" value="Guardar">
            </div>
        </div>
        <div class="col-md-5">
        <div class="visualizar-especies">
        <?php
        // Intento de refactorización
            $actionColumn = [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                        return Html::a('Ver',Url::to([$url,'id'=> $model->id]),['class' => 'btn btn-xs btn-success']);
                        },
                        'update' => function ($url, $model, $key) {
                        return Html::a('Mod',Url::to([$url,'id'=> $model->id]),['class' => 'btn btn-xs btn-info']);
                        },
                        'delete' => function ($url, $model, $key) {
                        return Html::a('Borrar',Url::to([$url,'id'=> $model->id]),['class' => 'btn btn-xs btn-danger']);
                        },
                    ],
                ];

            //$actionColumn['buttons']['view']('especies/view');
            //$actionColumn['buttons']['update']('especies/update');
            //$actionColumn['buttons']['delete']('especies/delete');

        ?>

            <?= GridView::widget([
                'dataProvider' => $especieDataProvider,
                'filterModel' => $especieSearchModel,
                'columns' => [
                    'nombre:text:Especie',
                    [
                            'class' => 'yii\grid\ActionColumn',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                return Html::a('Ver',Url::to(['especies/view','id'=> $model->id]),['class' => 'btn btn-xs btn-success']);
                                },
                                'update' => function ($url, $model, $key) {
                                return Html::a('Mod',Url::to(['especies/update','id'=> $model->id]),['class' => 'btn btn-xs btn-info']);
                                },
                                'delete' => function ($url, $model, $key) {
                                return Html::a('Borrar',Url::to(['especies/delete','id'=> $model->id]),['class' => 'btn btn-xs btn-danger']);
                                },
                            ],
                        ],
                ],
            ]); ?>
        </div>
        </div>
    </div>


<hr/>
<h2>Razas</h2>
<div class="row">
    <div class="col-md-4">
        <div class="registrar-razas">
            <?php $form = ActiveForm::begin(['id'=>'registrar-raza']) ?>
            <?= $form->field($razaModel, 'nombre')->textInput(['maxLength' => true])->label('Raza') ?>
            <?= $form->field($razaModel, 'especie_id')->dropDownList(Especies::nombres())->label('Especie') ?>
            <?php $form = ActiveForm::end() ?>
            <input type="submit" id="submitRaza" data-tipo="razas" value="Guardar">
        </div>
    </div>
    <div class="col-md-8">
        <div class='visualizar-razas'>
            <?= GridView::widget([
                'dataProvider' => $razaDataProvider,
                'filterModel' => $razaSearchModel,
                'columns' => [
                    'nombre:text:Raza',
                    'especie.nombre:text:Especie',
                    [
                            'class' => 'yii\grid\ActionColumn',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                return Html::a('Ver',Url::to(['razas/view','id'=> $model->id]),['class' => 'btn btn-xs btn-success']);
                                },
                                'update' => function ($url, $model, $key) {
                                return Html::a('Mod',Url::to(['razas/update','id'=> $model->id]),['class' => 'btn btn-xs btn-info']);
                                },
                                'delete' => function ($url, $model, $key) {
                                return Html::a('Borrar',Url::to(['razas/delete','id'=> $model->id]),['class' => 'btn btn-xs btn-danger']);
                                },
                            ],
                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>

</div>
