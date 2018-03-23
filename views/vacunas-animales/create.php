<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VacunasAnimales */

$this->title = 'Create Vacunas Animales';
$this->params['breadcrumbs'][] = ['label' => 'Vacunas Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacunas-animales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
