<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enfermedades_animales".
 *
 * @property int $animal_id
 * @property int $enfermedad_id
 * @property string $fecha_inicio
 * @property string $duracion
 *
 * @property Animales $animal
 * @property Enfermedades $enfermedad
 */
class EnfermedadesAnimales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enfermedades_animales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id', 'enfermedad_id', 'fecha_inicio', 'duracion'], 'required'],
            [['animal_id', 'enfermedad_id'], 'default', 'value' => null],
            [['animal_id', 'enfermedad_id'], 'integer'],
            [['fecha_inicio'], 'safe'],
            [['duracion'], 'string'],
            [['animal_id', 'enfermedad_id'], 'unique', 'targetAttribute' => ['animal_id', 'enfermedad_id']],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['enfermedad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enfermedades::className(), 'targetAttribute' => ['enfermedad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => 'Animal ID',
            'enfermedad_id' => 'Enfermedad ID',
            'fecha_inicio' => 'Fecha Inicio',
            'duracion' => 'Duracion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('enfermedadesAnimales');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedad()
    {
        return $this->hasOne(Enfermedades::className(), ['id' => 'enfermedad_id'])->inverseOf('enfermedadesAnimales');
    }
}
