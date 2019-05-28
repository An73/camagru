<?php
    require_once('application/config/DB.php');
    $dbname = 'camagru';
    DB::query("CREATE DATABASE IF NOT EXISTS $dbname");