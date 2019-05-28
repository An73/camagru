<?php

class View {

    function generate($contentView, $templateView, $data = null) {
        if (is_array($data)) {
            extract($data);
        }

        require 'application/views/'.$templateView;
    }
}