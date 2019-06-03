<?php

namespace application\controllers;
use application\core\Controller;
use application\config\DB;


class AccountController extends Controller {
    
    public function signupAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json') {
            $data = $this->getPublicData();

            if ($this->model->validateSignup($data)) {
                exit('OK');
            }
            else {
                exit($this->model->getError());
            }
        }
    }

    public function signinAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json') {
            $data = $this->getPublicData();

            if ($this->model->validateSignin($data['username'], $data['passwd'])) {
                $_SESSION['user'] = $data['username'];
                exit('OK');
            }
            else {
                exit($this->model->getError());
            }
        }
    }

    public function sessionAction() {
        $ret = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json') {
            if (!isset($_SESSION['user'])) {
                $ret['username'] = 'none';
            }
            else {
                $userFetch = $this->model->getUserByName($_SESSION['user']);
                $ret['username'] = $userFetch['Username'];
                $ret['avatar'] = $userFetch['Avatar'];
            }
        }
        exit(json_encode($ret));
    }

    public function logoutAction() {
        unset($_SESSION['user']);
    }

    public function activationAction() {
        if ($this->model->activationProfile($_GET['activation'])) {
            $this->view->redirect('');
            exit;
        }
        else {
            echo "NO 404";
        }
    }

    private function getPublicData() {
        $data = json_decode( file_get_contents('php://input'), true);
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value);
        }
        return $data;
    }

}