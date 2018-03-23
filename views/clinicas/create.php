<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Clinicas */

$this->title = 'Create Clinicas';
$this->params['breadcrumbs'][] = ['label' => 'Clinicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
