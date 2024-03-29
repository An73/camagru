<?php

use application\core\Router;
use application\core\Request;
use application\core\View;
use application\controllers;

require_once('application/config/setup.php');
session_start();
spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require_once $path;
    }
});

$request = new Request();
$router = new Router();
$router->parse($request);
if ($request->checkParams()) {
    $path = 'application\controllers\\'.$request->getController();
    $action = $request->getAction();
    $controller = new $path($request);
    $controller->$action();
}
else
    View::notFound();