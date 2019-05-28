<?php


class DB {
    protected static $instance = null;

    public static function instance() {
        if (self::$instance === null) {
            require_once('application/config/database.php');
            $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                            PDO::ATTR_EMULATE_PREPARES => TRUE);
            self::$instance = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $option);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = []) {
        if (!$args) {
            return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}