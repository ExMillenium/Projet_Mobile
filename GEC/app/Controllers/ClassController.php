<?php

class ClassController
{
    private ClassManager $classManager;
    private StudentManager $studentManager;

    public function __construct(ClassManager $classManager, StudentManager $studentManager)
    {
        $this->classManager = $classManager;
        $this->studentManager = $studentManager;
    }

    public function list()
    {
        $classes = $this->classManager->getAllClasses();
        require __DIR__ . "/../Views/classes/list.php";
    }

    public function show()
    {
        $id = $_GET['id'];
        $class = $this->classManager->getClass($id);
        $students = $this->studentManager->getStudentsByClass($id);

        require __DIR__ . "/../Views/classes/show.php";
    }

    public function addForm()
    {
        require __DIR__ . "/../Views/classes/add.php";
    }

    public function add()
    {
        $class = new Classe($_POST);
        $this->classManager->addClass($class);
        header("Location: index.php?page=classes");
    }

    public function editForm()
    {
        $id = $_GET['id'];
        $class = $this->classManager->getClass($id);
        require __DIR__ . "/../Views/classes/edit.php";
    }

    public function edit()
    {
        $class = new Classe($_POST);
        $this->classManager->updateClass($class);
        header("Location: index.php?page=classes");
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->classManager->deleteClass($id);
        header("Location: index.php?page=classes");
    }
}
