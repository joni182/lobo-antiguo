<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enfermedades".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 *
 * @property EnfermedadesAnimales[] $enfermedadesAnimales
 * @property Animales[] $animals
 * @property VacunasEnfermedades[] $vacunasEnfermedades
 * @property Vacunas[] $vacunas
 */
class Enfermedades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enfermedades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
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
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadesAnimales()
    {
        return $this->hasMany(EnfermedadesAnimales::className(), ['enfermedad_id' => 'id'])->inverseOf('enfermedad');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animales::className(), ['id' => 'animal_id'])->viaTable('enfermedades_animales', ['enfermedad_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunasEnfermedades()
    {
        return $this->hasMany(VacunasEnfermedades::className(), ['enfermedad_id' => 'id'])->inverseOf('enfermedad');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunas()
    {
        return $this->hasMany(Vacunas::className(), ['id' => 'vacuna_id'])->viaTable('vacunas_enfermedades', ['enfermedad_id' => 'id']);
    }
}
