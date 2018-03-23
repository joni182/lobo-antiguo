<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacunas_enfermedades".
 *
 * @property int $vacuna_id
 * @property int $enfermedad_id
 *
 * @property Enfermedades $enfermedad
 * @property Vacunas $vacuna
 */
class VacunasEnfermedades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacunas_enfermedades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacuna_id', 'enfermedad_id'], 'required'],
            [['vacuna_id', 'enfermedad_id'], 'default', 'value' => null],
            [['vacuna_id', 'enfermedad_id'], 'integer'],
            [['vacuna_id', 'enfermedad_id'], 'unique', 'targetAttribute' => ['vacuna_id', 'enfermedad_id']],
            [['enfermedad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enfermedades::className(), 'targetAttribute' => ['enfermedad_id' => 'id']],
            [['vacuna_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacunas::className(), 'targetAttribute' => ['vacuna_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vacuna_id' => 'Vacuna ID',
            'enfermedad_id' => 'Enfermedad ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedad()
    {
        return $this->hasOne(Enfermedades::className(), ['id' => 'enfermedad_id'])->inverseOf('vacunasEnfermedades');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacuna()
    {
        return $this->hasOne(Vacunas::className(), ['id' => 'vacuna_id'])->inverseOf('vacunasEnfermedades');
    }
}
