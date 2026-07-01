<?php

namespace Managers;

use PDO;

class EnrollManager
{
    public function __construct(private PDO $pdo) {}

    public function getAll(): array
    {
        return $this->pdo->query("SELECT * FROM enroll")->fetchAll();
    }
}
