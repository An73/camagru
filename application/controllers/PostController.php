<?php

namespace application\controllers;
use application\core\Controller;
use application\core\View;

class PostController extends Controller {

    public function indexAction() {
        $data['post'] = $this->model->getPost($_GET['idpost']);
        if (isset($_GET['idpost']) && $data['post']) {
            $data['title'] = 'Post';
            $data['css'] = 'post';
            $data['js'] = 'post';
            $this->view->generate('postView', 'defaultTemplate', $data);
        }
        else {
            View::notFound();
        }
    }

    public function countAction() {
        $data = $this->getPublicData();
        $ret = $this->model->getCountLikesAndComments($data['id']);
        if (isset($_SESSION['user'])) {
            $ret['session_user'] = $this->model->sessionUserLike($data['id']);
        }
        exit(json_encode($ret));
    }

    public function likeAction() {
        if (isset($_SESSION['user'])) {
            $data = $this->getPublicData();
            $this->model->like($data['id']);
        }
        else {
            View::notFound();
        }
    }

    public function commentsAction() {
        $data = $this->getPublicData();
        $ret = $this->model->getComments($data['id']);
        exit(json_encode($ret));
    }

    public function newcommentAction() {
        $data = $this->getPublicData();
        $this->model->newComment($data['id'], $data['comment']);
        $ret = $this->model->getCountLikesAndComments($data['id']);
        exit(json_encode($ret));
    }

    public function checkdeleteAction() {
        $data = $this->getPublicData();
        if (isset($_SESSION['user'])){
            exit($this->model->checkDelete($data['id']));
        }
        else {
            exit(FALSE);
        }
    }

    public function deleteAction() {
        $data = $this->getPublicData();
        if (isset($_SESSION['user'])) {
            $this->model->deletePost($data['id']);
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