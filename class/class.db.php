<?php

 class DB{

    private static $db = NULL;
    public static $CONNECTION_STRING = "mysql:host=lunaroverlord.cn3imgfeosz7.eu-west-1.rds.amazonaws.com;dbname=qr;charset=utf8";
    public static $DB_USER = "maksis";
    public static $DB_PASS = "esmugejs";

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
