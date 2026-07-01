<?php

class ConnectionDB {
    private static $host = "mysql-progmob.alwaysdata.net";
    private static $dbname = "progmob_bdd";
    private static $username = "progmob";
    private static $password = "M4root!1234%";

    public static function connect() {
        try {
            $pdo = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8",
                self::$username,
                self::$password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }
}

?>