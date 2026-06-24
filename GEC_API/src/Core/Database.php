<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private string $host = "mysql-progmob.alwaysdata.net";
    private string $dbname = "progmob_bdd";
    private string $username = "progmob";
    private string $password = "M4root!1234%";

    public function getConnection(): PDO
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );

            return $pdo;

        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Database connection failed"]);
            exit;
        }
    }
}
