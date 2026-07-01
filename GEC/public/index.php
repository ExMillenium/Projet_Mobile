<?php

// --- Autoload simple ---
spl_autoload_register(function ($class) {
    $paths = [
        "../app/Controllers/$class.php",
        "../app/Managers/$class.php",
        "../app/Models/$class.php",
        "../app/Core/$class.php"
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// --- Connexion DB ---
$db = ConnectionDB::connect();

// --- Managers ---
$studentManager = new StudentManager($db);
$classManager   = new ClassManager($db);
$enrollManager  = new EnrollManager($db);

// --- Routing ---
$page = $_GET['page'] ?? 'home';

switch ($page) {

    // -------------------------
    // STUDENTS
    // -------------------------
    case 'students':
        (new StudentController($studentManager, $classManager, $enrollManager))->list();
        break;

    case 'student_show':
        (new StudentController($studentManager, $classManager, $enrollManager))->show();
        break;

    case 'student_add':
        (new StudentController($studentManager, $classManager, $enrollManager))->addForm();
        break;

    case 'student_add_submit':
        (new StudentController($studentManager, $classManager, $enrollManager))->add();
        break;

    case 'student_edit':
        (new StudentController($studentManager, $classManager, $enrollManager))->editForm();
        break;

    case 'student_edit_submit':
        (new StudentController($studentManager, $classManager, $enrollManager))->edit();
        break;

    case 'student_delete':
        (new StudentController($studentManager, $classManager, $enrollManager))->delete();
        break;

    // -------------------------
    // CLASSES
    // -------------------------
    case 'classes':
        (new ClassController($classManager, $studentManager))->list();
        break;

    case 'class_show':
        (new ClassController($classManager, $studentManager))->show();
        break;

    case 'class_add':
        (new ClassController($classManager, $studentManager))->addForm();
        break;

    case 'class_add_submit':
        (new ClassController($classManager, $studentManager))->add();
        break;

    case 'class_edit':
        (new ClassController($classManager, $studentManager))->editForm();
        break;

    case 'class_edit_submit':
        (new ClassController($classManager, $studentManager))->edit();
        break;

    case 'class_delete':
        (new ClassController($classManager, $studentManager))->delete();
        break;


    // -------------------------
    // ENROLLMENTS
    // -------------------------
    case 'enroll':
        (new EnrollController($enrollManager, $studentManager, $classManager))->list();
        break;

    case 'enroll_add':
        (new EnrollController($enrollManager, $studentManager, $classManager))->addForm();
        break;

    case 'enroll_add_submit':
        (new EnrollController($enrollManager, $studentManager, $classManager))->add();
        break;

    case 'enroll_edit':
        (new EnrollController($enrollManager, $studentManager, $classManager))->editForm();
        break;

    case 'enroll_edit_submit':
        (new EnrollController($enrollManager, $studentManager, $classManager))->edit();
        break;

    case 'enroll_delete':
        (new EnrollController($enrollManager, $studentManager, $classManager))->delete();
        break;


    // -------------------------
    // HOME (Dashboard)
    // -------------------------
    case 'home':
    default:

        $studentCount = count($studentManager->getAllStudents());
        $classCount   = count($classManager->getAllClasses());
        $enrollCount  = count($enrollManager->getAllEnrollments());

        require "../app/Views/home.php";
        break;
}
