<?php

class StudentController
{
    private StudentManager $studentManager;
    private ClassManager $classManager;
    private EnrollManager $enrollManager;

    public function __construct(
        StudentManager $studentManager,
        ClassManager $classManager,
        EnrollManager $enrollManager
    ) {
        $this->studentManager = $studentManager;
        $this->classManager = $classManager;
        $this->enrollManager = $enrollManager;
    }

    public function list()
    {
        $students = $this->studentManager->getAllStudents();
        require __DIR__ . "/../Views/students/list.php";
    }

    public function show()
    {
        $ine = $_GET['ine'];

        $student = $this->studentManager->getStudent($ine);
        $history = $this->enrollManager->getHistoryByStudent($ine);

        require __DIR__ . "/../Views/students/show.php";
    }

    public function addForm()
    {
        require __DIR__ . "/../Views/students/add.php";
    }

    public function add()
    {
        $student = new Student($_POST);
        $this->studentManager->addStudent($student);
        header("Location: index.php?page=students");
    }

    public function editForm()
    {
        $ine = $_GET['ine'];
        $student = $this->studentManager->getStudent($ine);
        require __DIR__ . "/../Views/students/edit.php";
    }

    public function edit()
    {
        $student = new Student($_POST);
        $this->studentManager->updateStudent($student);
        header("Location: index.php?page=students");
    }

    public function delete()
    {
        $ine = $_GET['ine'];
        $this->studentManager->deleteStudent($ine);
        header("Location: index.php?page=students");
    }
}
