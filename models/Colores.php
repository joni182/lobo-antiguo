<?php

namespace app\models;

/**
 * This is the model class for table "colores".
 *
 * @property int $id
 * @property string $nombre
 */
class Colores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    public static function nombres()
    {
        return static::find()
            ->select('nombre')
            ->indexBy('id')
            ->column();
    }
}
