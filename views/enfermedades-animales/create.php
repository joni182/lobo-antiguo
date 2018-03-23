<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesAnimales */

$this->title = 'Create Enfermedades Animales';
$this->params['breadcrumbs'][] = ['label' => 'Enfermedades Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enfermedades-animales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
