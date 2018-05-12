<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Animales */

$this->title = 'Registrar animal';
$this->params['breadcrumbs'][] = ['label' => 'Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_razas_recolector' => $model_razas_recolector,
    ]) ?>

</div>
