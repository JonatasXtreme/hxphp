<?php
namespace HXPHP\System\Configs;

use HXPHP\System\Http\Request;

class GlobalConfig
{
    public $site;
    public $models;
    public $views;
    public $controllers;
    public $title;

    public function __construct()
    {
        $this->site = new \stdClass;

        $this->models = new \stdClass;
        $this->views = new \stdClass;
        $this->controllers = new \stdClass;

        //Site
        $request = new Request();
        $https = $request->server('HTTPS');

        $this->site->protocol = ($https && $https != 'off') ? 'https' : 'http';
        $this->site->host = $request->server('HTTP_HOST');
        $this->site->url = $this->site->protocol . '://' . $this->site->host;

        //Models
        $this->models->directory = getenv('APP_PATH') . 'models' . DIRECTORY_SEPARATOR;

        //Views
        $this->views->directory = getenv('APP_PATH') . 'views' . DIRECTORY_SEPARATOR;
        $this->views->extension = '.phtml';

        //Controller
        $this->controllers->directory = getenv('APP_PATH') . 'controllers' . DIRECTORY_SEPARATOR;
        $this->controllers->notFound = 'Error404Controller';

        //General
        $this->title = 'HXPHP Framework';
    }
}