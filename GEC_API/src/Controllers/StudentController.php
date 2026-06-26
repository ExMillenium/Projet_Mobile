<?php
namespace Controllers;

use Managers\StudentManager;

class StudentController
{
    private StudentManager $manager;

    public function __construct($pdo)
    {
        $this->manager = new StudentManager($pdo);
        header('Content-Type: application/json');
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

    public function getByClass($params)
    {
        if (!isset($params['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing class ID']);
            return;
        }

        try {
            $students = $this->manager->getByClass($params['id']);
            http_response_code(200);
            echo json_encode($students);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
