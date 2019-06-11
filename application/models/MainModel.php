<?php

namespace application\models;
use application\core\Model;
use application\config\DB;

class MainModel extends Model {
    public function getAllPosts() {
        return DB::run("SELECT * FROM posts ORDER BY Dat DESC")->fetchAll();
    }
}