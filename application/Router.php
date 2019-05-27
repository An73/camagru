<?php

namespace application;

class Router {

    private $routes;
    private $params;

    function __construct(){
        $this->routes = require_once('config/routes.php');
    }

    function parse(Request $request) {
        $url = trim($request->getUrl(), '/');
        if ($this->match($url)) {
            $request->setController(ucfirst($this->params['controller']).'Controller');
            $request->setAction($this->params['action'].'Action');

        }
    }

    private function match($url) {
        foreach($this->routes as $route => $params) {
            if (preg_match('#^'.$route.'$#', $url)) {
                $this->params = $params;
                return True;
            }
        }
        return False;
    }
}