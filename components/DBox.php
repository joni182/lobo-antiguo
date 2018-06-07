<?php

namespace app\components;

use Exception;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Exceptions\DropboxClientException;

class DBox
{
    private $_dropbox;
    public $urlImagenes = '/imagenes';

    public function __construct()
    {
        $_app = new DropboxApp(getenv('KEY_DROPBOX'), getenv('SECRET_DROPBOX'), getenv('ACCESS_TOKEN_DROPBOX'));
        $this->_dropbox = new Dropbox($_app);
    }

    public function getDropbox()
    {
        return $this->_dropbox;
    }

    /**
     * Comprueba si existe la carpeta pasada como parametro en dropbox y si no
     * existe la crea.
     * @param string $url Es la url completa de la carpeta a comprobar.
     * @return object Devuelve un objeto del tipo Kunnu\Dropbox\Models\FolderMetadata
     * que representa la carpeta creada.
     */
    public function aseguraExistsCarpeta($url)
    {
        if (($disponible = $this->fileExists($url)) === false) {
            return $this->getDropbox()->createFolder($url);
        } elseif ($disponible === null) {
            throw new Exception('Error en Dropbox.');
        }
    }

    /**
     * Comprueba si un fichero o carpeta existe en dropbox.
     * @param string Es la url completa de la carpeta o fichero acomprobar.
     * @param mixed $dir
     * @return bool|null Devuelva true si existe, false si no existe y null si
     * dropbox devuelve un error no esperado.
     */
    public function fileExists($dir)
    {
        try {
            $this->_dropbox->getMetadata($dir);
        } catch (DropboxClientException $e) {
            $mensaje = json_decode($e->getMessage());
            echo $e->getMessage();
            if (mb_substr($mensaje->error_summary, 0, 15) == 'path/not_found/') {
                return false;
            }
            return null;
        }

        return true;
    }

    public function subirArchivo($fichero, $carpeta, $nombre)
    {
        if (substr($carpeta, 0) != '/') {
            $carpeta = '/' . $carpeta;
        }

        if (substr($carpeta, -1) == '/') {
            $carpeta = substr($carpeta, 0, count($carpeta) - 2);
        }

        if (substr($nombre, 0) != '/') {
            $nombre = '/' . $nombre;
        }

        $pathToServerFile = $this->urlImagenes . $carpeta . $nombre;
        $this->aseguraExistsCarpeta($this->urlImagenes);
        $this->aseguraExistsCarpeta($this->urlImagenes . $carpeta);

        $pathToLocalFile = $fichero;
        $dropboxFile = new DropboxFile($pathToLocalFile);


        $file = $this->_dropbox->upload($dropboxFile, $pathToServerFile, ['autorename' => true]);
        return $file->getName();
    }

    public function listaDeFicheros()
    {
    }

    public function ultimaImagen()
    {
    }
}
