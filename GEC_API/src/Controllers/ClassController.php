<?php

namespace Controllers;

use Managers\ClassManager;

class ClassController
{
    private ClassManager $manager;

    public function __construct($pdo)
    {
        $this->manager = new ClassManager($pdo);
    }

    public function getAll()
    {
        try {
            $students = $this->manager->getAll();
            http_response_code(200);
            echo json_encode($students);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }   
}