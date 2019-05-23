<?php

class Request {
    public $controller;
    public $action;
    public $params;
    public $url;

    public function __contruct() {
        $this->url = $_SERVER['REQUEST_URI'];
    }
}