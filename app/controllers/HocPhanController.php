<?php
class HocPhanController {
    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->conn = new Database();
        $this->conn = $this->conn->getConnection();
    }

    public function index() {
        $query = "SELECT MaHP, TenHP, SoTinChi, SoLuongDuKien FROM HocPhan";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $hocPhanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/hocphan/index.php';
    }
}
?>