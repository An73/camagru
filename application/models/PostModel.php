<?php

namespace application\models;
use application\core\Model;
use application\config\DB;

class PostModel extends Model {
    public function getPost($id) {
        $fetch = DB::run('SELECT posts.ID, Dat, Username, Post, Avatar FROM posts 
                            INNER JOIN users
                            ON posts.UserID = users.id
                            WHERE posts.id = ?', [$id])->fetch();
        return $fetch;
    }

    public function getCountLikesAndComments($id) {
        $count['likes'] = DB::run('SELECT COUNT(*) FROM likes WHERE PostID=?', [$id])->fetch()['COUNT(*)'];
        $count['comments'] = DB::run('SELECT COUNT(*) FROM comments WHERE PostID=?', [$id])->fetch()['COUNT(*)'];
        return $count;
    }

    public function sessionUserLike($id) {
        $check = DB::run('SELECT * FROM likes
                            INNER JOIN users
                            ON likes.UserID = users.ID
                            WHERE likes.PostID=? AND
                            users.Username=?', [$id, $_SESSION['user']])->fetch();
        if ($check === FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    public function like($id) {
        $check = $this->sessionUserLike($id);
        $userID = DB::run('SELECT ID FROM users WHERE Username=?', [$_SESSION['user']])->fetch()['ID'];
        if ($check === FALSE) {
            $stmt = DB::prepare('INSERT INTO likes (UserID, PostID) VALUE (?, ?)');
            $stmt->execute([$userID, $id]);
        }
        else {
            DB::run('DELETE FROM likes WHERE UserID=? AND PostID=?', [$userID, $id]);
        }
    }
}