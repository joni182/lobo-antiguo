<?php

namespace app\models;

/**
 * This is the model class for table "animales".
 *
 * @property int $id
 * @property string $nombre
 * @property int $raza_id
 * @property int $especie_id
 * @property string $chip
 * @property string $observaciones
 * @property string $created_at
 *
 * @property Especies $especie
 * @property Razas $raza
 * @property EnfermedadesAnimales[] $enfermedadesAnimales
 * @property Enfermedades[] $enfermedads
 * @property Tratamientos[] $tratamientos
 * @property Vacunaciones[] $vacunaciones
 * @property VacunasAnimales[] $vacunasAnimales
 * @property Vacunas[] $vacunas
 */
class Animales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['peso'], 'filter', 'filter' => function ($value) {
                return str_replace(',', '.', $value);
            }],
            [['nombre', 'raza_id', 'especie_id'], 'required'],
            [['raza_id', 'especie_id', 'chip', 'ppp'], 'default'],
            [['raza_id', 'especie_id'], 'integer'],
            [['ppp'], 'boolean'],
            [['observaciones'], 'string'],
            [['sexo', 'peso', 'created_at'], 'safe'],
            [['nombre', 'chip'], 'string', 'max' => 255],
            [['chip'], 'unique'],
            [['especie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especies::className(), 'targetAttribute' => ['especie_id' => 'id']],
            [['raza_id'], 'exist', 'skipOnError' => true, 'targetClass' => Razas::className(), 'targetAttribute' => ['raza_id' => 'id']],
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
            'raza_id' => 'Raza ID',
            'especie_id' => 'Especie ID',
            'chip' => 'Chip',
            'observaciones' => 'Observaciones',
            'created_at' => 'Registrado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecie()
    {
        return $this->hasOne(Especies::className(), ['id' => 'especie_id'])->inverseOf('animales');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaza()
    {
        return $this->hasOne(Razas::className(), ['id' => 'raza_id'])->inverseOf('animales');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadesAnimales()
    {
        return $this->hasMany(EnfermedadesAnimales::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedads()
    {
        return $this->hasMany(Enfermedades::className(), ['id' => 'enfermedad_id'])->viaTable('enfermedades_animales', ['animal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamientos::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunaciones()
    {
        return $this->hasMany(Vacunaciones::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunasAnimales()
    {
        return $this->hasMany(VacunasAnimales::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunas()
    {
        return $this->hasMany(Vacunas::className(), ['id' => 'vacuna_id'])->viaTable('vacunas_animales', ['animal_id' => 'id']);
    }
}
