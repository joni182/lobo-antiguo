<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacunas_animales".
 *
 * @property int $animal_id
 * @property int $vacuna_id
 * @property string $fecha
 *
 * @property Animales $animal
 * @property Vacunas $vacuna
 */
class VacunasAnimales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacunas_animales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id', 'vacuna_id'], 'required'],
            [['animal_id', 'vacuna_id'], 'default', 'value' => null],
            [['animal_id', 'vacuna_id'], 'integer'],
            [['fecha'], 'safe'],
            [['animal_id', 'vacuna_id'], 'unique', 'targetAttribute' => ['animal_id', 'vacuna_id']],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['vacuna_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacunas::className(), 'targetAttribute' => ['vacuna_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => 'Animal ID',
            'vacuna_id' => 'Vacuna ID',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('vacunasAnimales');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacuna()
    {
        return $this->hasOne(Vacunas::className(), ['id' => 'vacuna_id'])->inverseOf('vacunasAnimales');
    }
}
