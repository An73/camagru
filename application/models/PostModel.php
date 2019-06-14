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

    public function getComments($id) {
        return DB::run('SELECT Username, Comment FROM comments
                        INNER JOIN users
                        ON comments.UserID = users.ID
                        WHERE comments.PostID=?', [$id])->fetchAll();
    }

    public function newComment($id, $comment) {
        $user = DB::run('SELECT ID, Email, Notification FROM users WHERE Username=?', [$_SESSION['user']])->fetch();
        $userID = $user['ID'];
        $stmt = DB::prepare('INSERT INTO comments (PostID, UserID, Comment) VALUE (?, ?, ?)');
        $stmt->execute([$id, $userID, $comment]);
        if ($user['Notification']) {
            $this->sendEmailComment($user['Email'], $comment);
        }
    }

    public function checkDelete($id) {
        $check = DB::run('SELECT * FROM posts
                    INNER JOIN users
                    ON posts.UserID = users.ID
                    WHERE users.Username=? AND posts.ID=?', [$_SESSION['user'], $id])->fetch();
        if ($check) {
            return TRUE;
        }
        return FALSE;
    }

    public function deletePost($id) {
        if ($this->checkDelete($id)) {
            DB::run('')
        }
    }

    private function sendEmailComment($email, $comment) {
        $encoding = "utf-8";
        $subject_preferences = array(
		    "input-charset" => $encoding,
		    "output-charset" => $encoding,
		    "line-length" => 76,
		    "line-break-chars" => "\r\n"
        );
        $subject = 'Your post is commented';
	    $header = "Content-type: text/html; charset=".$encoding." \r\n";
	    $header .= "From: camagru <administration@camagru.com> \r\n";
	    $header .= "MIME-Version: 1.0 \r\n";
	    $header .= "Content-Transfer-Encoding: 8bit \r\n";
	    $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $subject, $subject_preferences);

        $message = '
            <html>
                <head>
                    <title>Your post is commented</title>
                </head>
                <body>
                    <p>Comment: "' . $comment . '"</p>
                </body>
            </html>';
        return mail($email, $subject, $message, $header);
    }
}