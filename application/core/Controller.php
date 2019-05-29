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
    }

    protected function loadModel($model) {
        $path = 'application\models\\'.ucfirst($model);
        return new $path;
    }

}