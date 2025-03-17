<?php
class DangKyController {
    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->conn = new Database();
        $this->conn = $this->conn->getConnection();
    }

    public function index() {
        $maSV = $_SESSION['mssv'] ?? null;

        if (!$maSV) {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login");
            exit();
        }

        // Lấy danh sách học phần đã đăng ký
        $query = "SELECT hp.MaHP, hp.TenHP, hp.SoTinChi
                  FROM ChiTietDangKy ctdk
                  JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                  JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
                  WHERE dk.MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        $dangKyList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/dangky/index.php';
    }

    public function add($maHP) {
        session_start();
        $maSV = $_SESSION['mssv'] ?? null;

        if (!$maSV) {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login");
            exit();
        }

        // Kiểm tra xem đã đăng ký học phần này chưa
        $checkQuery = "SELECT COUNT(*) FROM ChiTietDangKy ctdk
                       JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                       WHERE dk.MaSV = :maSV AND ctdk.MaHP = :maHP";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->bindParam(':maHP', $maHP);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            // Tạo bản ghi mới trong DangKy nếu chưa có
            $dkQuery = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (CURDATE(), :maSV)";
            $stmt = $this->conn->prepare($dkQuery);
            $stmt->bindParam(':maSV', $maSV);
            $stmt->execute();
            $maDK = $this->conn->lastInsertId();

            // Thêm vào ChiTietDangKy
            $ctdkQuery = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (:maDK, :maHP)";
            $stmt = $this->conn->prepare($ctdkQuery);
            $stmt->bindParam(':maDK', $maDK);
            $stmt->bindParam(':maHP', $maHP);
            $stmt->execute();
        }

        header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky");
        exit();
    }

    public function delete($maHP) {
        $maSV = $_SESSION['mssv'] ?? null;
    
        if (!$maSV) {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login");
            exit();
        }
    

        $dkQuery = "SELECT dk.MaDK 
                    FROM DangKy dk
                    JOIN ChiTietDangKy ctdk ON dk.MaDK = ctdk.MaDK
                    WHERE dk.MaSV = :maSV AND ctdk.MaHP = :maHP";
        $stmt = $this->conn->prepare($dkQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->bindParam(':maHP', $maHP);
        $stmt->execute();
        $maDK = $stmt->fetchColumn();
    
        if ($maDK) {
            $deleteQuery = "DELETE FROM ChiTietDangKy WHERE MaDK = :maDK AND MaHP = :maHP";
            $stmt = $this->conn->prepare($deleteQuery);
            $stmt->bindParam(':maDK', $maDK);
            $stmt->bindParam(':maHP', $maHP);
            $stmt->execute();
        }
    
        header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky");
        exit();
    }
    public function deleteAll() {
        $maSV = $_SESSION['mssv'] ?? null;
    
        if (!$maSV) {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login");
            exit();
        }
    
        // Xóa tất cả bản ghi trong ChiTietDangKy liên quan đến MaSV
        $deleteQuery = "DELETE ctdk FROM ChiTietDangKy ctdk
                        JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                        WHERE dk.MaSV = :maSV";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
    
        // Xóa các bản ghi trong DangKy của MaSV để làm sạch dữ liệu
        $deleteDangKyQuery = "DELETE FROM DangKy WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($deleteDangKyQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
    
        header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky?message=deleted_all");
        exit();
    }
}
?>