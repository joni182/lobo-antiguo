<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clinicas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 *
 * @property Vacunaciones[] $vacunaciones
 * @property Veterinarios[] $veterinarios
 */
class Clinicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clinicas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'direccion'], 'string', 'max' => 255],
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
            'direccion' => 'Direccion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunaciones()
    {
        return $this->hasMany(Vacunaciones::className(), ['clinica_id' => 'id'])->inverseOf('clinica');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarios()
    {
        return $this->hasMany(Veterinarios::className(), ['clinica_id' => 'id'])->inverseOf('clinica');
    }
}
