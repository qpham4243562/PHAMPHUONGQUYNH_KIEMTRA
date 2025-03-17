<?php
class AuthController {
    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->conn = new Database();
        $this->conn = $this->conn->getConnection();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mssv'])) {
            $mssv = $_POST['mssv'];
            $query = "SELECT * FROM SinhVien WHERE MaSV = :mssv";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':mssv', $mssv);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['mssv'] = $user['MaSV'];
                $_SESSION['hoten'] = $user['HoTen'];
                header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien");
                exit();
            } else {
                header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login?error=1");
                exit();
            }
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login");
        exit();
    }
}
?>