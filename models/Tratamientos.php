<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tratamientos".
 *
 * @property int $id
 * @property int $animal_id
 * @property int $medicamento_id
 * @property int $veterinario_id
 * @property string $fecha_inicio
 * @property string $duracion
 * @property string $observaciones
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Animales $animal
 * @property Medicamentos $medicamento
 * @property Veterinarios $veterinario
 */
class Tratamientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tratamientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id', 'medicamento_id', 'fecha_inicio', 'duracion'], 'required'],
            [['animal_id', 'medicamento_id', 'veterinario_id'], 'default', 'value' => null],
            [['animal_id', 'medicamento_id', 'veterinario_id'], 'integer'],
            [['fecha_inicio', 'created_at', 'updated_at'], 'safe'],
            [['duracion', 'observaciones'], 'string'],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['medicamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamentos::className(), 'targetAttribute' => ['medicamento_id' => 'id']],
            [['veterinario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Veterinarios::className(), 'targetAttribute' => ['veterinario_id' => 'id']],
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
            'medicamento_id' => 'Medicamento ID',
            'veterinario_id' => 'Veterinario ID',
            'fecha_inicio' => 'Fecha Inicio',
            'duracion' => 'Duracion',
            'observaciones' => 'Observaciones',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('tratamientos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamento()
    {
        return $this->hasOne(Medicamentos::className(), ['id' => 'medicamento_id'])->inverseOf('tratamientos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinario()
    {
        return $this->hasOne(Veterinarios::className(), ['id' => 'veterinario_id'])->inverseOf('tratamientos');
    }
}
