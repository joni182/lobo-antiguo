<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacunaciones".
 *
 * @property int $id
 * @property int $animal_id
 * @property int $vacuna_id
 * @property int $clinica_id
 * @property string $fecha_hora
 *
 * @property Animales $animal
 * @property Clinicas $clinica
 * @property Vacunas $vacuna
 */
class Vacunaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacunaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id', 'vacuna_id', 'clinica_id'], 'default', 'value' => null],
            [['animal_id', 'vacuna_id', 'clinica_id'], 'integer'],
            [['fecha_hora'], 'safe'],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['clinica_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clinicas::className(), 'targetAttribute' => ['clinica_id' => 'id']],
            [['vacuna_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacunas::className(), 'targetAttribute' => ['vacuna_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'animal_id' => 'Animal ID',
            'vacuna_id' => 'Vacuna ID',
            'clinica_id' => 'Clinica ID',
            'fecha_hora' => 'Fecha Hora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('vacunaciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinica()
    {
        return $this->hasOne(Clinicas::className(), ['id' => 'clinica_id'])->inverseOf('vacunaciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacuna()
    {
        return $this->hasOne(Vacunas::className(), ['id' => 'vacuna_id'])->inverseOf('vacunaciones');
    }
}
