<?php

use app\models\Animales;
use app\models\Razas;
use app\models\Especies;
use yii\helpers\Url;
use yii\helpers\Html;
 ?>

<div class="col-md-4" >
    <div class="thumbnail">
        <a href=<?= Url::to(['animales/view', 'id' => $model->id]) ?>>
            <img src=<?= $model->rutaPrincipal ?> alt=<?= $model->nombre ?> style="height:100%">
            <div class="caption row">
                <div class="col-md-4">
                    <p><?= $model->nombre ?></p>
                </div>
            </div>
     </a>
   </div>
</div>
