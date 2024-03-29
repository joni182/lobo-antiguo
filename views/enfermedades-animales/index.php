<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnfermedadesAnimalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enfermedades Animales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enfermedades-animales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Enfermedades Animales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'animal_id',
            'enfermedad_id',
            'fecha_inicio',
            'duracion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
