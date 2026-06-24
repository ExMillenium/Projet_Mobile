<?php

namespace Managers;

use PDO;

class ClassManager
{
    public function __construct(private PDO $pdo) {}

    public function getAll(): array
    {
        return $this->pdo->query("SELECT * FROM classes")->fetchAll();
    }
}
