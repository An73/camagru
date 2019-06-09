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

    public function publishAction() {
        if (isset($_SESSION['user'])) {
            $data = str_replace(' ', '+', $_POST['img']);
            $data = base64_decode($data);
            file_put_contents('public/resource/work/work.png', $data);

            switch ($_POST['filter']){
                 case 'clear':
                    $imageData = base64_encode(file_get_contents('public/resource/work/work.png'));
                    $src = 'data: '.mime_content_type('public/resource/work/work.png').';base64,'.$imageData;
                    exit($src);
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

    private function applyFilter($pathFilter, $x, $y) {
        $wm = imagecreatefrompng($pathFilter);
        $wmW=imagesx($wm);
        $wmH=imagesy($wm);
        $image=imagecreatetruecolor($wmW, $wmH);
        $image=imagecreatefrompng('public/resource/work/work.png');
        $size=getimagesize('public/resource/work/work.png');
        $cx=$size[0]-$wmW+$x;
        $cy=$size[1]-$wmH+$y;
        imagecopyresampled ($image, $wm, $cx, $cy, 0, 0, $wmW, $wmH, $wmW, $wmH);
        imagepng($image,'public/resource/work/work.png',9);
        imagedestroy($image);
        imagedestroy($wm);
        $imageData = base64_encode(file_get_contents('public/resource/work/work.png'));
        $src = 'data: '.mime_content_type('public/resource/work/work.png').';base64,'.$imageData;
        exit($src);
    }
}