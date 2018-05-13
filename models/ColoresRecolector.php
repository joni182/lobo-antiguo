<?php

namespace app\models;

class ColoresRecolector extends \yii\base\Model
{
    public $colores = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['colores'], 'safe'],
        ];
    }

    public function attributes()
    {
        return ['colores'];
    }
}
