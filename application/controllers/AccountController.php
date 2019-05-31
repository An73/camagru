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

            if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                exit('Email is incorrect');
            }
            else if (DB::run("SELECT * FROM users WHERE Email=?", [$data['email']])->fetch()) {
                exit('This email is busy');
            }
            else if (DB::run("SELECT * FROM users WHERE Username=?", [$data['username']])->fetch()) {
                exit('This username is busy');
            }
            else if (!preg_match('/[a-zA-Z0-9_]{2,10}/', $data['username'])) {
                exit('Username is incorrect, must be from 2 to 10 characters (a-z A-Z 0-9 _)');
            }
            else if (!preg_match('/[a-zA-Z0-9_-]{6,12}/', $data['passwd1'])) {
                exit('Password is incorrect, must be from 6 to 12 characters (a-z A-Z 0-9 _ -)');
            }
            else if ($data['passwd1'] !== $data['passwd2']) {
                exit('Passwords do not match');
            }
            DB::prepare("INSERT INTO users (Username, Email, Passwd, Avatar) VALUE (?, ?, ?, ?)");
            DB::execute([$data['username'], $data['email'], password_hash($data['passwd1'], PASSWORD_DEFAULT), "fake"]);
            exit('OK');
        }
    }
}