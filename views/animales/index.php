<?php

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
        <?= Html::a('Registrar Especie', ['especies/create'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Registrar Raza', ['razas/create'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'nombre',
            'raza.nombre:text:Raza',
            'especie.nombre:text:Especie',
            'sexo',
            'chip',
            //'observaciones:ntext',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>