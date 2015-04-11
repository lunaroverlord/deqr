<?php

 class DB{

    private static $db = NULL;
    public static $CONNECTION_STRING = "mysql:host=http://104.236.42.108/;dbname=qr;charset=utf8";
    public static $DB_USER = "olaf@localhost";
    public static $DB_PASS = "asdf1234";

    public static function getInstance() {
        if (is_null(self::$db)) {
            self::$db = new PDO(self::$CONNECTION_STRING, self::$DB_USER, self::$DB_PASS);
	    if(is_null(self::$db))
		    echo "db error";
        }
        return self::$db;
    }

}
?>
