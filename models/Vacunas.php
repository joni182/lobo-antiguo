<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacunas".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Vacunaciones[] $vacunaciones
 * @property VacunasAnimales[] $vacunasAnimales
 * @property Animales[] $animals
 * @property VacunasEnfermedades[] $vacunasEnfermedades
 * @property Enfermedades[] $enfermedads
 */
class Vacunas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacunas';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunaciones()
    {
        return $this->hasMany(Vacunaciones::className(), ['vacuna_id' => 'id'])->inverseOf('vacuna');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunasAnimales()
    {
        return $this->hasMany(VacunasAnimales::className(), ['vacuna_id' => 'id'])->inverseOf('vacuna');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animales::className(), ['id' => 'animal_id'])->viaTable('vacunas_animales', ['vacuna_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunasEnfermedades()
    {
        return $this->hasMany(VacunasEnfermedades::className(), ['vacuna_id' => 'id'])->inverseOf('vacuna');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedads()
    {
        return $this->hasMany(Enfermedades::className(), ['id' => 'enfermedad_id'])->viaTable('vacunas_enfermedades', ['vacuna_id' => 'id']);
    }
}
