<?php

namespace Controllers;

use Managers\StudentManager;

class StudentController
{
    private StudentManager $manager;

    public function __construct($pdo)
    {
        $this->manager = new StudentManager($pdo);
    }

    public function getAll()
    {
        echo json_encode($this->manager->getAll());
    }

    public function getByClass($params)
    {
        echo json_encode($this->manager->getByClass($params['id']));
    }
}
