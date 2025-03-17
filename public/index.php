<?php
require_once __DIR__ . '/../app/controllers/SinhVienController.php';


$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'sinhvien';
$urlParts = explode('/', $url);

$controller = new SinhVienController();
$action = $urlParts[1] ?? 'index';
$maSV = $urlParts[2] ?? null;

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        if ($maSV) {
            $controller->edit($maSV);
        }
        break;
    case 'delete':
        if ($maSV) {
            $controller->delete($maSV);
        }
        break;
    case 'detail':
        if ($maSV) {
            $controller->detail($maSV);
        }
        break;
    default:
        $controller->index();
        break;
}
?>