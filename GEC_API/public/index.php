<?php

use Core\Database;
use Core\Router;
use Controllers\StudentController;
use Controllers\ClassController;

require_once "../vendor/autoload.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$pdo = (new Database())->getConnection();
$router = new Router();

// Students
$router->get("/api/students", fn() => (new StudentController($pdo))->getAll());
$router->get("/api/classes/{id}/students", fn($p) => (new StudentController($pdo))->getByClass($p));

// Classes
$router->get("/api/classes", fn() => (new ClassController($pdo))->getAll());

$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
