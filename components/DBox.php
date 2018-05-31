<?php

namespace app\components;

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

class DBox
{
    private $_dropbox;

    public function __construct()
    {
        $_app = new DropboxApp(getenv('KEY_DROPBOX'), getenv('SECRET_DROPBOX'), getenv('ACCESS_TOKEN_DROPBOX'));
        $this->_dropbox = new Dropbox($_app);
    }

    public function getDropbox()
    {
        return $this->_dropbox;
    }
}
