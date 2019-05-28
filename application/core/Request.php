<?php

namespace application\core;

class Request {
    private $controller;
    private $action;
    private $model;
    private $url;

    public function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
    }

    public function checkParams() {
        if ($this->action && $this->controller) {
            return True;
        }
        return False;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getModel() {
        return $this->model;
    }

}