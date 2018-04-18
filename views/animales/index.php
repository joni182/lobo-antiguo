<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Animal', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Gestionar Especies y Razas', ['especies-razas/index'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'nombre',
            'especie.nombre:text:Especie',
            'raza.nombre:text:Raza',
            'sexo',
            'peso:weight',
            'ppp:boolean',
            'chip',
            'observaciones:ntext',
            'created_at:datetime',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                        return Html::a('Ver',Url::to(['animales/view','id'=> $model->id]),['class' => 'btn btn-xs btn-success']);
                        },
                        'update' => function ($url, $model, $key) {
                        return Html::a('Mod',Url::to(['animales/update','id'=> $model->id]),['class' => 'btn btn-xs btn-info']);
                        },
                        'delete' => function ($url, $model, $key) {
                        return Html::a('Borrar',Url::to(['animales/delete','id'=> $model->id]),[
                            'class' => 'btn btn-xs btn-danger',
                            'data' => [
                                'method' => 'post',
                                'confirm' => "Estas seguro de querer borrar a $model->nombre",
                            ],
                        ]);
                        },
                    ],
            ],
        ],
    ]); ?>
</div>
