<?php

namespace app\models;

/**
 * This is the model class for table "especies".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Animales[] $animales
 * @property Razas[] $razas
 */
class Especies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especies';
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
     * Método que devuelve un array todas las filas de la tabla Especies.
     * @return array ids como clave y los nombres como valor.
     */
    public static function nombres()
    {
        $nombres = Especies::->find()->select('id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimales()
    {
        return $this->hasMany(Animales::className(), ['especie_id' => 'id'])->inverseOf('especie');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRazas()
    {
        return $this->hasMany(Razas::className(), ['especie_id' => 'id'])->inverseOf('especie');
    }
}
