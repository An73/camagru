<?php

namespace application;

class Request {
    private $controller;
    private $action;
    private $params;
    private $url;

    public function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
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

    public function getUrl() {
        return $this->url;
    }

    public function test() {
        return $this->controller;
    }

}