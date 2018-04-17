<?php

use yii\grid\GridView;

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EspeciesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Especies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especies-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
