<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\imagine\Image;

/**
 * This is the model class for table "animales".
 *
 * @property int $id
 * @property string $nombre
 * @property string $peso
 * @property bool $ppp
 * @property string $chip
 * @property string $sexo
 * @property string $observaciones
 * @property string $created_at
 *
 * @property AnimalesColores[] $animalesColores
 * @property Colores[] $colors
 * @property AnimalesRazas[] $animalesRazas
 * @property Razas[] $razas
 * @property EnfermedadesAnimales[] $enfermedadesAnimales
 * @property Enfermedades[] $enfermedads
 * @property Tratamientos[] $tratamientos
 * @property Vacunaciones[] $vacunaciones
 * @property VacunasAnimales[] $vacunasAnimales
 * @property Vacunas[] $vacunas
 */
class Animales extends \yii\db\ActiveRecord
{
    public $fotos;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animales';
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['fotos']);
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
            [['fotos'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg', 'maxFiles' => 6],
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

    public function upload()
    {
        if ($this->fotos === [0 => '']) {
            return true;
        }

        $i = 0;

        foreach ($this->fotos as $foto) {
            while (file_exists($nombre = "uploads/{$this->id}-{$i}.jpg")) {
                $i++;
            }
            $nombre = Yii::getAlias('@webroot/uploads/') . $this->id . '-' . $i++ . '.' . 'jpg';
            $res = $foto->saveAs($nombre);
            if ($res) {
                Image::thumbnail($nombre, 450, null)->save($nombre);
            }
        }
        return true;
    }

    public function getRutasImagenes()
    {
        $imagenes = static::obtenerListadoDeImagenes($this->id);

        if ($imagenes !== []) {
            return $imagenes;
        }

        return [Url::to('/uploads/') . 'default.jpg'];
    }

    public static function obtenerListadoDeImagenes($id = '.+', $directorio = 'uploads/')
    {
        // Array en el que obtendremos los resultados
        $res = [];

        // Agregamos la barra invertida al final en caso de que no exista
        if (substr($directorio, -1) != '/') {
            $directorio .= '/';
        }

        // Creamos un puntero al directorio y obtenemos el listado de archivos
        $dir = @dir($directorio) or die("getFileList: Error abriendo el directorio $directorio para leerlo");
        while (($archivo = $dir->read()) !== false) {
            // Obviamos los archivos ocultos
            if ($archivo[0] == '.') {
                continue;
            }
            if (is_dir($directorio . $archivo)) {
            } elseif (is_readable($directorio . $archivo) && preg_match("/^$id\-.*\.jpg$/", $archivo)) {
                $res[] = $directorio . $archivo;
            }
        }
        $dir->close();
        return $res;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesColores()
    {
        return $this->hasMany(AnimalesColores::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColors()
    {
        return $this->hasMany(Colores::className(), ['id' => 'color_id'])->viaTable('animales_colores', ['animal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesRazas()
    {
        return $this->hasMany(AnimalesRazas::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRazas()
    {
        return $this->hasMany(Razas::className(), ['id' => 'raza_id'])->viaTable('animales_razas', ['animal_id' => 'id']);
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
