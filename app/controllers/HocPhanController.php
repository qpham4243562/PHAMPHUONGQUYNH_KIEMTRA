<?php
class HocPhanController {
    private $conn;

    public function __construct() {
        // Kết nối đến cơ sở dữ liệu
        require_once __DIR__ . '/../config/database.php';
        $this->conn = new Database();
        $this->conn = $this->conn->getConnection();
    }

    public function index() {
        $hocPhanList = $this->getHocPhan();
        // Load view
        require_once __DIR__ . '/../views/hocphan/index.php';
    }

    public function getHocPhan() {
        $query = "SELECT * FROM HocPhan";
        $stmt = $this->conn->prepare($query); // Sử dụng prepare để an toàn hơn
        $stmt->execute();

        $hocPhanList = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả hàng
        return $hocPhanList;
    }
}
?>