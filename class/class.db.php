<?php

 class DB{

    private static $db = NULL;
    public static $CONNECTION_STRING = "mysql:host=localhost;dbname=qr;charset=utf8";
    public static $DB_USER = "root";
    public static $DB_PASS = "root";

    public static function getInstance() {
        if (is_null(self::$db)) {
            self::$db = new PDO(self::$CONNECTION_STRING, self::$DB_USER, self::$DB_PASS);
        }
        return self::$db;
    }

}
?>