<?php

namespace application\core;

class View {

    public function generate($contentView, $templateView, $data = null) {
        if (is_array($data)) {
            extract($data);
        }

        require 'application/views/template/'.$templateView.'.php';
    }

    public function redirect($url) {
        header('location: /'.$url);
		exit;
    }
}