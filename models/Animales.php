<?php

namespace app\models;

use app\components\DBox;
use DateTime;
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
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $razas_rec;
    public $colores_rec;
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
        return array_merge(parent::attributes(), ['fotos', 'razas_rec', 'colores_rec']);
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
            [['nombre'], 'required'],
            [['chip', 'ppp'], 'default'],
            [['ppp'], 'boolean'],
            [['observaciones', 'tamanio'], 'string'],
            [['sexo', 'peso', 'created_at', 'razas_rec', 'colores_rec'], 'safe'],
            [['nombre', 'chip'], 'string', 'max' => 255],
            [['chip'], 'unique'],
            [['fotos'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg', 'maxFiles' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre',
            'ppp' => '¿Potencialmente peligroso?',
            'chip' => 'Chip',
            'tamanio' => 'Tamaño',
            'observaciones' => 'Observaciones',
            'created_at' => 'Registrado',
            'colores_rec' => 'Colores',
            'razas_rec' => 'Razas',
        ];
    }

    public static function tamaniosDisponibles()
    {
        return [
            'pequenio' => 'Pequeño',
            'mediano' => 'Mediano',
            'grande' => 'Grande',
            'muy grande' => 'Muy grande',
        ];
    }

    public static function sexosDisponibles()
    {
        return [
            'Hembra' => 'Hembra',
            'Macho' => 'Macho',
        ];
    }

    public function establecerFotoPrincipal($ruta)
    {
        $carpetaPrincipal = Yii::getAlias('@fotoprincipal');
        if (!file_exists($carpetaPrincipal)) {
            mkdir($carpetaPrincipal);
        }
        $principal = "$carpetaPrincipal/{$this->id}-principal.jpg";

        return copy($ruta, $principal);
    }

    public function borrarFotoPrincipal()
    {
        $fotoPrincipal = Yii::getAlias('@fotoprincipal') . "{$this->id}-principal.jpg";
        if (file_exists($fotoPrincipal)) {
            return unlink($fotoPrincipal);
        }
    }

    public function upload()
    {
        $dBox = new DBox();
        $dBox->aseguraExistsCarpeta('/imagenes');
        $ruta = "/imagenes/{$this->id}";
        $dBox->aseguraExistsCarpeta($ruta);

        if ($this->fotos === [0 => '']) {
            if ($this->scenario == self::SCENARIO_CREATE) {
            }
            return true;
        }

        $i = 0;
        $d = (new DateTime())->format('Y-m-d\TH:i:s.u');

        foreach ($this->fotos as $foto) {
            $dBox->subirArchivo($foto->tempName . '/' . $foto->name, $this->id, $d . $i++ . '.jpg');

            // if ($res) {
            //     Image::thumbnail($nombre, 450, null)->save($nombre);
            // }
        }
        return true;
    }

    /**
     * Devuelve la ruta de la imagen principal que identifica al animal, si no
     * existe devuelve una imagen por defecto.
     * @return string La ruta a la imagen principal
     */
    public function getRutaPrincipal():string
    {
        if (file_exists(($fotoPrincipal = Yii::getAlias('@fotoprincipal') . "{$this->id}-principal.jpg"))) {
            return "uploads/fotos_principal/{$this->id}-principal.jpg";
        }
        return 'uploads/default.jpg';
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

    public function asignarRazas()
    {
        if ($this->razas_rec) {
            foreach ($this->razas_rec as $raza_id) {
                $animalRaza = new AnimalesRazas();
                $animalRaza->attributes = ['animal_id' => $this->id, 'raza_id' => $raza_id];
                $animalRaza->save();
                // $p = AnimalesRazas::findOne(['animal_id' => $this->id]);
            }
        }
    }

    public function desasignarRazas()
    {
        return AnimalesRazas::deleteAll(['animal_id' => $this->id]);
    }

    public function asignarColores()
    {
        if ($this->colores_rec) {
            foreach ($this->colores_rec as $color_id) {
                $animalColor = new AnimalesColores();
                $animalColor->attributes = ['animal_id' => $this->id, 'color_id' => $color_id];
                $animalColor->save();
            }
        }
    }

    public function desasignarColores()
    {
        return AnimalesColores::deleteAll(['animal_id' => $this->id]);
    }

    public function coloresAsignadosId()
    {
        $coloresId = [];

        foreach ($this->colors as $value) {
            $coloresId[] = $value->id;
        }

        return $coloresId;
    }

    public function razasAsignadasId()
    {
        $razasId = [];

        foreach ($this->razas as $value) {
            $razasId[] = $value->id;
        }

        return $razasId;
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
