<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$js = <<<JS
    $('.search-button').on('click', function(){
        $('form').first().slideToggle();
    });
JS;
$this->registerJs($js);
$this->title = 'Animales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-index">
    <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-md-6">
                <?= Html::a('Registrar Animal', ['create'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Gestionar Especies y Razas', ['especies-razas/index'], ['class' => 'btn btn-info']) ?>
            </div>
            <div class="search-button">
                <?= Html::img('search.png',[
                    'class' => 'col-sm-offset-4',
                    'alt' => 'Buscar animal',
                    'width' => '35',
                    'height' => '35'])
                ?>
                <span class="">
                    Buscar Animal
                </span>
        </div>
    </div>
    <div class="row">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_ficha',
            ]) ?>
        </div>


    <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'nombre',
            'sexo',
            [
                'attribute' => 'razas',
                'format' => 'text',
                'value' => function ($model) {
                    $nombres = "";
                    foreach ($model->razas as $raza) {
                        $nombres = $nombres . ' ' . $raza['nombre'];
                    }
                    return $nombres;
                },
            ],
            [
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
    ]); ?> -->
</div>
