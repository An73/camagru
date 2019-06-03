<?php

namespace application\controllers;
use application\core\Controller;
use application\config\DB;


class AccountController extends Controller {
    
    public function signupAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json') {
            $data = json_decode( file_get_contents('php://input'), true);
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars($value);
            }

            if ($this->model->validateSignup($data)) {
                exit('OK');
            }
            else {
                exit($this->model->getError());
            }
        }
    }

    public function activationAction() {
        echo $_GET['activation'];
    }

}