<?php

class EnrollController {

    private EnrollManager $enrollManager;
    private StudentManager $studentManager;
    private ClassManager $classManager;

    public function __construct(
        EnrollManager $enrollManager,
        StudentManager $studentManager,
        ClassManager $classManager
    ) {
        $this->enrollManager = $enrollManager;
        $this->studentManager = $studentManager;
        $this->classManager = $classManager;
    }

    public function list() {
        $enrollments = $this->enrollManager->getAllEnrollments();
        require __DIR__ . "/../Views/enroll/list.php";
    }

    public function addForm() {
        $students = $this->studentManager->getAllStudents();
        $classes = $this->classManager->getAllClasses();
        require __DIR__ . "/../Views/enroll/add.php";
    }

    public function add() {
        $enroll = new Enroll($_POST);
        $this->enrollManager->enrollStudent($enroll);
        header("Location: index.php?page=enroll");
    }

    public function edit() {
        $enroll = new Enroll($_POST);
        $this->enrollManager->updateEnrollment($enroll);

        header("Location: index.php?page=enroll");
    }

    public function editForm() {
        $ine = $_GET['ine'];
        $class = $_GET['class'];

        $enroll = $this->enrollManager->getEnrollment($ine, $class);

        require __DIR__ . "/../Views/enroll/edit.php";
    }

    public function delete() {
        $ine = $_GET['ine'];
        $class = $_GET['class'];
        $this->enrollManager->deleteEnrollment($ine, $class);
        header("Location: index.php?page=enroll");
    }
}
