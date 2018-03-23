<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "veterinarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property int $clinica_id
 * @property string $created_at
 *
 * @property Tratamientos[] $tratamientos
 * @property Clinicas $clinica
 */
class Veterinarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'veterinarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['clinica_id'], 'default', 'value' => null],
            [['clinica_id'], 'integer'],
            [['created_at'], 'safe'],
            [['nombre', 'apellido'], 'string', 'max' => 255],
            [['nombre', 'apellido'], 'unique', 'targetAttribute' => ['nombre', 'apellido']],
            [['clinica_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clinicas::className(), 'targetAttribute' => ['clinica_id' => 'id']],
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
            'apellido' => 'Apellido',
            'clinica_id' => 'Clinica ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamientos::className(), ['veterinario_id' => 'id'])->inverseOf('veterinario');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinica()
    {
        return $this->hasOne(Clinicas::className(), ['id' => 'clinica_id'])->inverseOf('veterinarios');
    }
}
