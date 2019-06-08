<?php

namespace application\controllers;
use application\core\Controller;
use application\config\DB;

class ShotController extends Controller {

    public function shotAction() {
        if (isset($_SESSION['user'])) {
            $data['title'] = 'Shot';
            $data['css'] = 'shot';
            $data['js'] = 'shot';
            $this->view->generate('shotView', 'defaultTemplate', $data);
        }
        else {
            echo "NO 404";
        }
    }

    public function publishAction() {
        if (isset($_SESSION['user'])) {
            $data = str_replace(' ', '+', $_POST['img']);
            $data = base64_decode($data);
            file_put_contents('public/resource/test.png', $data);
        }
        else {
            echo "NO 404";
        }
    }
}