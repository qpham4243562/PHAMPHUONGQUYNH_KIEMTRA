<?php
session_start();
require_once __DIR__ . '/../app/controllers/SinhVienController.php';
require_once __DIR__ . '/../app/controllers/HocPhanController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'sinhvien';
$urlParts = explode('/', $url);

$controllerName = ucfirst($urlParts[0]) . 'Controller';
$action = $urlParts[1] ?? 'index';
$param = $urlParts[2] ?? null;


if (!isset($_SESSION['loggedin']) && $controllerName !== 'AuthController' && $action !== 'login') {
    header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login");
    exit();
}

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    switch ($action) {
        case 'index':
            $controller->index();
            break;
        case 'create':
            $controller->create();
            break;
        case 'edit':
            if ($param) {
                $controller->edit($param);
            }
            break;
        case 'delete':
            if ($param) {
                $controller->delete($param);
            }
            break;
        case 'detail':
            if ($param) {
                $controller->detail($param);
            }
            break;
        case 'login':
            $controller->login();
            break;
        case 'logout':
            $controller->logout();
            break;
        default:
            $controller->index();
            break;
    }
} else {
    echo "Controller không tồn tại!";
}
?>