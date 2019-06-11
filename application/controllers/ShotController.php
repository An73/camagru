<?php

namespace application\controllers;
use application\core\Controller;
use application\config\DB;

class ShotController extends Controller {

    public function shotAction() {
        if (isset($_SESSION['user'])) {
            $data['title'] = 'Shot';
            $data['css'] = 'shot';
            $data['js'] = 'shot';
            $this->view->generate('shotView', 'defaultTemplate', $data);
        }
        else {
            echo "NO 404";
        }
    }

    public function filterAction() {
        if (isset($_SESSION['user'])) {
            $data = str_replace(' ', '+', $_POST['img']);
            $data = base64_decode($data);
            file_put_contents('public/resource/work/work.jpeg', $data);

            switch ($_POST['filter']){
                 case 'clear':
                    $imageData = base64_encode(file_get_contents('public/resource/work/work.jpeg'));
                    $src = 'data: '.mime_content_type('public/resource/work/work.jpeg').';base64,'.$imageData;
                    exit($src);
                case 'pepe':
                    $this->applyFilter('public/resource/filter/pepe.png', -300, 0);
                case 'raccoon-1':
                    $this->applyFilter('public/resource/filter/raccoon1.png', 20, 30);
                case 'raccoon-2':
                    $this->applyFilter('public/resource/filter/raccoon2.png', -300, 78);
                case 'rocketman':
                    $this->applyFilter('public/resource/filter/rocketman.png', 10, -140);
                case 'penguin':
                    $this->applyFilter('public/resource/filter/penguin.png', -20, 0);
                case 'cat':
                    $this->applyFilter('public/resource/filter/cat.png', -330, -30);
            }

        }
        else {
            echo "NO 404";
        }
    }

    public function publishAction() {
        if (isset($_SESSION['user'])) {
            $fileName = $_SESSION['user'] . date("YmdHis") . '.jpeg';
            copy('public/resource/work/work.jpeg', 'public/resource/posts/'.$fileName);
            $this->model->insertPost($_SESSION['user'], $fileName);
        }
        else {
            echo "NO 404";
        }
    }

    private function applyFilter($pathFilter, $x, $y) {
        $wm = imagecreatefrompng($pathFilter);
        $wmW=imagesx($wm);
        $wmH=imagesy($wm);
        $check = mime_content_type('public/resource/work/work.jpeg');
        $image=imagecreatetruecolor($wmW, $wmH);
        $image=imagecreatefromjpeg('public/resource/work/work.jpeg');
        $size=getimagesize('public/resource/work/work.jpeg');
        $cx=$size[0]-$wmW+$x;
        $cy=$size[1]-$wmH+$y;
        imagecopyresampled ($image, $wm, $cx, $cy, 0, 0, $wmW, $wmH, $wmW, $wmH);
        imagejpeg($image,'public/resource/work/work.jpeg',100);
        imagedestroy($image);
        imagedestroy($wm);
        $imageData = base64_encode(file_get_contents('public/resource/work/work.jpeg'));
        $src = 'data: '.mime_content_type('public/resource/work/work.jpeg').';base64,'.$imageData;
        exit($src);
    }
}