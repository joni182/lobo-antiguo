<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Razas */

$this->title = 'Update Razas: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Razas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->nombre]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="razas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
