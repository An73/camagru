<?php

namespace application\controllers;
use application\core\Controller;
use application\config\DB;
use application\core\View;


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
            View::notFound();
        }
    }

    public function editAction() {
        if (isset($_SESSION['user'])) {
            $data['title'] = 'Edit Profile';
            $data['css'] = 'edit_profile';
            $data['js'] = 'edit_profile';
            $this->view->generate('editProfileView', 'defaultTemplate', $data);
        }
        else {
            View::notFound();
        }
    }

    public function editnameAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json') {
            $data = $this->getPublicData();
            if (isset($_SESSION['user'])) {
                if ($this->model->updateName($data)) {
                    $_SESSION['user'] = $data['newUsername'];
                    exit('OK');
                }
                else {
                    exit($this->model->getError());
                }
            }
            else {
                View::notFound();
            }
        }
        else {
            View::notFound();
        }
    }

    public function editpasswdAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json') {
            $data = $this->getPublicData();
            if (isset($_SESSION['user'])) {
                if ($this->model->updatePasswd($data)) {
                    exit('OK');
                }
                else {
                    exit($this->model->getError());
                }
            }
            else {
                View::notFound();
            }
        }
        else {
            View::notFound();
        }
    }

    public function editemailAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json') {
            $data = $this->getPublicData();
            if (isset($_SESSION['user'])) {
                if ($this->model->updateEmail($data)) {
                    exit('OK');
                }
                else {
                    exit($this->model->getError());
                }
            }
            else {
                View::notFound();
            }
        }
        else {
            View::notFound();
        }
    }

    public function resendAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->getPublicData();
            if ($this->model->resendPasswd($data)) {
                exit('OK');
            }
            else {
                exit($this->model->getError());
            }
        }
        else {
            View::notFound();
        }
    }

    public function editavatarAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
                $name = basename($_FILES['avatar']['name']);
                $path = "public/resource/avatars/" . $name;
                if (exif_imagetype($_FILES['avatar']['tmp_name']) == IMAGETYPE_JPEG ||
                    exif_imagetype($_FILES['avatar']['tmp_name']) == IMAGETYPE_PNG) {
                        move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
                        $this->model->updateAvatar($path, $_SESSION['user']);
                }
            }
        }
        $this->view->redirect('account/edit');
    }

    public function notinfoAction() {
        if (isset($_SESSION['user'])) {
            exit($this->model->getInfoNotification());
        }
        else {
            View::notFound();
        }
    }

    public function editnotAction() {
        if (isset($_SESSION['user'])) {
            exit($this->model->editNotification());
        }
        else {
            View::notFound();
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