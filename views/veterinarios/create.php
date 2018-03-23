<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Veterinarios */

$this->title = 'Create Veterinarios';
$this->params['breadcrumbs'][] = ['label' => 'Veterinarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="veterinarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
