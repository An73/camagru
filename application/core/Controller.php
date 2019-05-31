<?php

namespace application\core;

abstract class Controller {

    protected $model;
    protected $view;
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->model = $this->loadModel($request->getModel());
        $this->view = new View();
        require_once('application/config/DB.php');
    }

    protected function loadModel($model) {
        $path = 'application\models\\'.ucfirst($model);
        return new $path;
    }

}