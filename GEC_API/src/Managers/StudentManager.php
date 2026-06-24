<?php

namespace Managers;

use PDO;

class StudentManager
{
    public function __construct(private PDO $pdo) {}

    public function getAll(): array
    {
        return $this->pdo->query("SELECT * FROM students")->fetchAll();
    }

    public function getByClass(string $classId): array
    {
        $sql = "SELECT s.*
                FROM students s
                JOIN enroll e ON e.StudentINE = s.INE
                WHERE e.ClassEnrolled = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $classId]);

        return $stmt->fetchAll();
    }

}
