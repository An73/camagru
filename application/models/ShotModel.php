<?php

namespace application\models;
use application\core\Model;
use application\config\DB;

class ShotModel extends Model {
    private $error;

    public function insertPost($user, $link) {
        $id = DB::run("SELECT ID FROM users WHERE Username=?",[$user])->fetch()['ID'];
        $stmt = DB::prepare("INSERT INTO posts (UserID, Post) VALUE (?, ?)");
        $stmt->execute([$id, $link]);
    }
}