<?php

use yii\grid\GridView;

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
            'nombre',
            'especie.nombre:text:Especie',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
