<?php

use application\Router;
use application\Request;

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

echo $request->test();