<?php

namespace app\components;

use yii\base\Behavior;

class DevuelveNombresBehavior extends Behavior
{
    /**
     * Método que devuelve un array todas las filas de la tabla Especies.
     * @return array ids como clave y los nombres como valor.
     */
    public static function nombres()
    {
        return self::find()
            ->select('nombre')
            ->indexBy('id')
            ->column();
    }
}
