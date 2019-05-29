<?php

namespace application\controllers;
use application\core\Controller;



class MainController extends Controller {
    
    public function indexAction() {
        $data['title'] = 'Camagru';
        $data['css'] = 'main';
        $data['js'] = 'main';
        $this->view->generate('mainView', 'defaultTemplate', $data);
    }
}