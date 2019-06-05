<?php

namespace application\models;
use application\core\Model;
use application\config\DB;

class AccountModel extends Model {
    private $error;

    public function validateSignup($data) {
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email is incorrect';
            return False;
        }
        else if (DB::run("SELECT * FROM users WHERE Email=?", [$data['email']])->fetch()) {
            $this->error = 'This email is busy';
            return False;
        }
        else if (DB::run("SELECT * FROM users WHERE Username=?", [$data['username']])->fetch()) {
            $this->error = 'This username is busy';
            return False;
        }
        else if (!preg_match('/[a-zA-Z0-9_]{2,10}/', $data['username'])) {
            $this->error = 'Username is incorrect, must be from 2 to 10 characters (a-z A-Z 0-9 _)';
            return False;
        }
        else if (!preg_match('/[a-zA-Z0-9_-]{6,12}/', $data['passwd1'])) {
            $this->error = 'Password is incorrect, must be from 6 to 12 characters (a-z A-Z 0-9 _ -)';
            return False;
        }
        else if ($data['passwd1'] !== $data['passwd2']) {
            $this->error = 'Passwords do not match';
            return False;
        }
        else if (!$this->activationMail($data['email'])) {
            $this->error = 'Activation email not sent, try again later';
            return False;
        }
        $stmt = DB::prepare("INSERT INTO users (Username, Email, Passwd, Avatar, Activation) VALUE (?, ?, ?, ?, ?)");
        $stmt->execute([$data['username'], $data['email'], 
                        password_hash($data['passwd1'], PASSWORD_DEFAULT), "/public/resource/avatars/default.jpg", 
                        hash('sha256', $data['email'])]);
        return True;
    }

    public function activationProfile($data) {
        if (!DB::run("SELECT * FROM users WHERE Activation=?", [$data])->fetch()) {
            $this->error = 'Activation Key Incorrect';
            return False;
        }
        DB::run("UPDATE users SET status=1 WHERE Activation=?", [$data]);
        return True;
    }

    public function getUserByName($username) {
        return DB::run("SELECT * FROM users WHERE Username=?", [$username])->fetch();
    }

    public function validateSignin($username, $passwd) {
        $fetch = DB::run("SELECT * FROM users WHERE Username=?", [$username])->fetch();
        if (!$fetch || !password_verify($passwd, $fetch['Passwd'])) {
            $this->error = 'Username or Password is incorrect';
            return False;
        }
        else if (!DB::run("SELECT * FROM users WHERE Username=? AND Status=1", [$username])->fetch()) {
            $this->error = 'Not confirmed email';
            return False;
        }
        return True;
    }

    public function updateName($data) {
        if (!preg_match('/[a-zA-Z0-9_]{2,10}/', $data['newUsername'])) {
            $this->error = 'Username is incorrect, must be from 2 to 10 characters (a-z A-Z 0-9 _)';
            return False;
        }
        else if (DB::run("SELECT * FROM users WHERE Username=?", [$data['newUsername']])->fetch()) {
            $this->error = 'This username is busy';
            return False;
        }
        DB::run("UPDATE users SET Username=? WHERE Username=?", [$data['newUsername'], $_SESSION['user']]);
        return True;
    }

    public function updatePasswd($data) {
        $fetch = DB::run("SELECT * FROM users WHERE Username=?", [$_SESSION['user']])->fetch();
        if (!password_verify($data['passwd'], $fetch['Passwd'])) {
            $this->error = 'Your Password is incorrect';
            return False;
        }
        else if ($data['newPasswd1'] !== $data['newPasswd2']) {
            $this->error = 'Passwords do not match';
            return False;
        }
        else if (!preg_match('/[a-zA-Z0-9_-]{6,12}/', $data['newPasswd1'])) {
            $this->error = 'Password is incorrect, must be from 6 to 12 characters (a-z A-Z 0-9 _ -)';
            return False;
        }
        DB::run("UPDATE users SET Passwd=? WHERE Username=?", [password_hash($data['newPasswd1'], PASSWORD_DEFAULT), $_SESSION['user']]);
        return True;
    }

    public function updateEmail($data) {
        if (DB::run("SELECT * FROM users WHERE Email=?", [$data['newEmail']])->fetch()) {
            $this->error = 'This email is busy';
            return False;
        }
        else if(!filter_var($data['newEmail'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email is incorrect';
            return False;
        }
        DB::run("UPDATE users SET Email=? WHERE Username=?", [$data['newEmail'], $_SESSION['user']]);
        return True;
    }

    public function getError() {
        return $this->error;
    }

    private function activationMail($email) {
        $encoding = "utf-8";
        $subject_preferences = array(
		    "input-charset" => $encoding,
		    "output-charset" => $encoding,
		    "line-length" => 76,
		    "line-break-chars" => "\r\n"
        );
        $subject = 'Confirmation of registration';
	    $header = "Content-type: text/html; charset=".$encoding." \r\n";
	    $header .= "From: camagru <administration@camagru.com> \r\n";
	    $header .= "MIME-Version: 1.0 \r\n";
	    $header .= "Content-Transfer-Encoding: 8bit \r\n";
	    $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $subject, $subject_preferences);

        $message = '
            <html>
                <head>
                    <title>Confirmation of registration</title>
                </head>
                <body>
                    <p>That would confirm registration on site "Camagru" click on the link 
                    <a href="http://localhost:8080/account/activation?activation=' . hash('sha256', $email) . '">Activation</a></p>
                </body>
            </html>';
        return mail($email, $subject, $message, $header);
    }
}