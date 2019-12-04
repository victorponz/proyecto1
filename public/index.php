<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/core/bootstrap.php';
use ProyectoWeb\core\App;
use ProyectoWeb\core\Router;
use ProyectoWeb\core\Request;

use ProyectoWeb\database\Connection;
use ProyectoWeb\app\utils\MyLog;

$routes = require_once __DIR__ . '/../src/app/routes.php';
$router = new Router($routes);
App::bind('router', $router);

App::bind('connection', Connection::make(App::get('config')['database']));

App::bind('rootDir', __DIR__ . '/');

App::bind("logger", MyLog::load($config['logs']['channel'], __DIR__ ."/../logs/" . $config['logs']['filename'],  $config['logs']['level']));

require $router->direct(Request::uri());