<?php

namespace application\controllers;
use application\core\Controller;



class AccountController extends Controller {
    
    public function signupAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json') {
            $data = json_decode( file_get_contents('php://input'), true);
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars($value);
            }

            echo preg_match('/^[a-zA-Z0-9_]{2,10}$/', "aA0_");
            // if (!preg_match_all('/[a-zA-Z0-9_]{2, 10}/', $data['username'])) {
            //     echo 'Wrong';
            // }
            // else {
            //     echo 'OK';
            // }
        }
    }
}