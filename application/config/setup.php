<?php
    use application\config\DB;
    require_once('application/config/DB.php');
    $dbname = 'camagru';
    DB::query("CREATE DATABASE IF NOT EXISTS $dbname");
    DB::query("USE $dbname");
    
    DB::query("CREATE TABLE IF NOT EXISTS users
                    (ID INT(10) AUTO_INCREMENT PRIMARY KEY, 
                    Username VARCHAR(30) NOT NULL,
                    Email VARCHAR(320) NOT NULL,
                    Passwd VARCHAR(255) NOT NULL,
                    Avatar VARCHAR(255) NOT NULL,
                    Activation VARCHAR(255) NOT NULL,
                    Status BOOLEAN DEFAULT 0)");
    
    DB::query("CREATE TABLE IF NOT EXISTS posts
                    (ID INT(10) AUTO_INCREMENT PRIMARY KEY,
                    UserID INT(10) NOT NULL,
                    Dat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    Post VARCHAR(255) NOT NULL)");
    
    DB::query("CREATE TABLE IF NOT EXISTS likes
                    (ID INT(10) AUTO_INCREMENT PRIMARY KEY,
                    UserID INT(10) NOT NULL,
                    PostID INT(10) NOT NULL)");
    
    DB::query("CREATE TABLE IF NOT EXISTS comments
                    (ID INT(10) AUTO_INCREMENT PRIMARY KEY,
                    PostID INT(10) NOT NULL,
                    UserID INT(10) NOT NULL,
                    Comment VARCHAR(200) NOT NULL)");