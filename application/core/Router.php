<?php

namespace application\core;

class Router {

    private $routes;
    private $params;

    function __construct(){
        $this->routes = require_once('application/config/routes.php');
    }

    function parse(Request $request) {
        $url = trim($request->getUrl(), '/');
        $url = explode("?", $url)[0];
        if ($this->match($url)) {
            $request->setController(ucfirst($this->params['controller']).'Controller');
            $request->setModel(ucfirst($this->params['controller']).'Model');
            $request->setAction($this->params['action'].'Action');
        }
        else {
            //View::errorCode(404);
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