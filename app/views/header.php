<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Sinh viên</title>
    <style>
        header {
            background-color: #333;
            padding: 10px;
            color: white;
        }
        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien">Sinh viên</a>
            <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/hocphan">Học phần</a>
            <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/dangky">Đăng ký</a>
            <?php
            session_start();
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo "<a href='/PHAMPHUONGQUYNH_KIEMTRA/public/auth/logout'>Đăng xuất</a>";
            } else {
                echo "<a href='/PHAMPHUONGQUYNH_KIEMTRA/public/auth/login'>Đăng nhập</a>";
            }
            ?>
        </nav>
    </header>