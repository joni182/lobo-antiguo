<?php

use yii\helpers\Url;
use yii\helpers\Html;


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

$this->title = 'Gestión de Especies y Razas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="especies-razas">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h2>Especies</h2>
    <div class="row justify-content-md-center">
        <div class="registrar-especies">
            <div class="col-md-4">
                <?= $this->render('/especies/_form',[
                    'model' => $especieModel,
                    ]) ?>
            </div>
        </div>
        <div class="col-md-5">
        <div class="visualizar-especies">
            <?= $this->render('/especies/index',[
                'dataProvider' => $especieDataProvider,
                'searchModel' => $especieSearchModel,
                ])
            ?>
        </div>
        </div>
    </div>
<hr/>
<h2>Razas</h2>
<div class="row">
    <div class="col-md-4">
        <div class="registrar-razas">
            <?= $this->render('/razas/_form',[
                'model' => $razaModel,
                ]) ?>
        </div>
    </div>
    <div class="col-md-8">
        <div class='visualizar-razas'>
            <?= $this->render('/razas/index',[
                'dataProvider' => $razaDataProvider,
                'searchModel' => $razaSearchModel,
                ])
            ?>

        </div>
    </div>
</div>

</div>
