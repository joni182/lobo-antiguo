<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
    $('.animal-img').hover(function(){
        $(this).find('.oculto').fadeIn();
    }, function(){
        $(this).find('.oculto').fadeOut();
    });
JS;

$this->registerJs($js);
?>
<div class="animales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de BORRAR a '.$model->nombre.' de la base de datos?',
                'method' => 'post',
            ],
            ]) ?>
        </p>

        <div class="row">
            <?php
            $rutasImagenes =  $model->getRutasImagenes();
            $fotoPrincipal = file_exists(($rutaPrincipal = "uploads/fotos_principal/{$model->id}-principal.jpg"))? $rutaPrincipal: '/uploads/default.jpg';
            ?>
            <div class="col-md-6 animal-img" style="position: relative;">
                <?= Html::img($fotoPrincipal, [
                    'style' => [
                        'border-radius' => '2%'
                    ],
                ])
                    ?>

                    <?= Html::a('Borrar Avatar', ['borrar-foto-principal', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-danger oculto',
                        'style' => 'margin:10px;position: absolute; left: 340px; top: 10px;',
                        'data' => [
                            'confirm' => '¿Estás seguro de BORRAR esta foto principal?',
                            'method' => 'post',
                        ],
                        ])?>
                    </div>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'nombre',
                                'sexo',
                                [
                                    'attribute' => 'razas',
                                    'format' => 'text',
                                    'value' => function ($model) {
                                        $nombres = "";
                                        foreach ($model->razas as $raza) {
                                            $nombres = $nombres . ' ' . $raza['nombre'].',';
                                        }
                                        return $nombres;
                                    },
                                ],
                                [
                                    'label' => 'Colores',
                                    'attribute' => 'colors',
                                    'format' => 'text',
                                    'value' => function ($model) {
                                        $nombres = "";
                                        foreach ($model->colors as $color) {
                                            $nombres = $nombres . ' ' . $color['nombre'] . ',';
                                        }
                                        return $nombres;
                                    },
                                ],
                                'peso:weight',
                                'ppp:boolean:PPP',
                                'chip',
                                'observaciones:ntext',
                                'created_at:datetime',
                            ],
                            ]) ?>
                        </div>
                    </div>
                    <?php if ($rutasImagenes[0] != "/uploads/default.jpg"):?>
                        <div class="row" style='align-items:center;display:flex;flex-wrap:wrap;border:solid;margin-top:20px;border-color:#dddddd;background-color:#f9f9f9'>
                            <?php foreach ($rutasImagenes as $ruta): ?>
                                <div class='animal-img' style="position:relative;width:20%;margin:20px">
                                    <?= $img = Html::img($ruta,[
                                        'style' => [
                                            'width' => '100%',
                                            'border-radius' => '2%'
                                        ],
                                        ])?>
                                        <div class='oculto' style='margin:10px;position: absolute; left: 10px; top: 10px;'>
                                            <?= Html::a('Hacer foto principal', ['cambiar-principal', 'id' => $model->id,'ruta' => $ruta], [
                                                'class' => 'btn btn-xs btn-info',
                                                'style' => 'margin:5px',
                                                'data' => [
                                                    'confirm' => '¿Estás seguro de hacer esta foto la foto de perfil?',
                                                    'method' => 'post',
                                                ],
                                            ])
                                            ?>
                                            <?= Html::a('Borrar', ['borrar-imagen', 'id' => $model->id,'ruta' => $ruta], [
                                                'class' => 'btn btn-xs btn-danger',
                                                'style' => 'margin:5px',
                                                'data' => [
                                                    'confirm' => '¿Estás seguro de BORRAR esta foto definitivamente?',
                                                    'method' => 'post',
                                                ],
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif ?>

                        <div style="margin:20px">
                            <?php $form = ActiveForm::begin(
                                [
                                    'action' => Url::to(['animales/agregar-imagenes','id' => $model->id]),
                                    'options' => [
                                        'enctype' => 'multipart/form-data'
                                    ]
                                ]
                            ); ?>
                            <?= $form
                            ->field($model, 'fotos[]')
                            ->fileInput(['multiple' => true, 'accept' => 'image/*'])
                            ->label('Agregar nuevas fotos') ?>
                            <div class="form-group">
                                <?= Html::submitButton('Guardar imagenes', ['class' => 'btn btn-success']) ?>
                            </div>
                            <?php $form->end() ?>
                        </div>

                    </div>
