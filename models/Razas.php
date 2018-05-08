<?php

namespace app\models;

/**
 * This is the model class for table "razas".
 *
 * @property int $id
 * @property string $nombre
 * @property int $especie_id
 *
 * @property Animales[] $animales
 * @property Especies $especie
 */
class Razas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'razas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'especie_id'], 'required'],
            [['especie_id'], 'default', 'value' => null],
            [['especie_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre', 'especie_id'], 'unique', 'targetAttribute' => ['nombre', 'especie_id']],
            [['especie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especies::className(), 'targetAttribute' => ['especie_id' => 'id']],
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
            'especie_id' => 'Especie ID',
        ];
    }

    public static function nombres()
    {
        return static::find()
            ->select('nombre')
            ->indexBy('id')
            ->column();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesRazas()
    {
        return $this->hasMany(AnimalesRazas::className(), ['raza_id' => 'id'])->inverseOf('raza');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimales()
    {
        return $this->hasMany(Animales::className(), ['id' => 'animal_id'])->viaTable('animales_razas', ['raza_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecie()
    {
        return $this->hasOne(Especies::className(), ['id' => 'especie_id'])->inverseOf('razas');
    }
}
