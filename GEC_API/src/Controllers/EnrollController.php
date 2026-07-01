<?php

namespace Controllers;

use Managers\EnrollManager;

class EnrollController
{
    private EnrollManager $manager;

    public function __construct($pdo)
    {
        $this->manager = new EnrollManager($pdo);
    }

    public function getAll()
    {
        echo json_encode($this->manager->getAll());
    }
}
