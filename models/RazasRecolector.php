<?php

namespace app\models;

class RazasRecolector extends \yii\base\Model
{
    public $razas = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['razas'], 'required'],
        ];
    }

    public function attributes()
    {
        return ['razas'];
    }
}
