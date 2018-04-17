<?php

use yii\grid\GridView;

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RazasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Razas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="razas-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
