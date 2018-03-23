<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacunacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacunaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacunaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vacunaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'animal_id',
            'vacuna_id',
            'clinica_id',
            'fecha_hora',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
