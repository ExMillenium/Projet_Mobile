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
        echo json_encode($this->manager->getAll());
    }
}
