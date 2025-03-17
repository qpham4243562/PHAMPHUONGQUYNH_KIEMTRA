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


        $query = "SELECT hp.MaHP, hp.TenHP, hp.SoTinChi
                  FROM ChiTietDangKy ctdk
                  JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                  JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
                  WHERE dk.MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        $dangKyList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $statusQuery = "SELECT TrangThai FROM DangKy WHERE MaSV = :maSV ORDER BY MaDK DESC LIMIT 1";
        $stmt = $this->conn->prepare($statusQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        $trangThai = $stmt->fetchColumn() ?? 'ChuaLuu';


        require_once __DIR__ . '/../views/dangky/index.php';
    }

    public function add($maHP) {
        $maSV = $_SESSION['mssv'] ?? null;

        if (!$maSV) {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login");
            exit();
        }


        $statusQuery = "SELECT TrangThai FROM DangKy WHERE MaSV = :maSV ORDER BY MaDK DESC LIMIT 1";
        $stmt = $this->conn->prepare($statusQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        $trangThai = $stmt->fetchColumn() ?? 'ChuaLuu';

        if ($trangThai === 'DaLuu') {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky?message=already_saved");
            exit();
        }

        $checkQuery = "SELECT COUNT(*) FROM ChiTietDangKy ctdk
                       JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                       WHERE dk.MaSV = :maSV AND ctdk.MaHP = :maHP";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->bindParam(':maHP', $maHP);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {

            $dkQuery = "INSERT INTO DangKy (NgayDK, MaSV, TrangThai) VALUES (CURDATE(), :maSV, 'ChuaLuu')";
            $stmt = $this->conn->prepare($dkQuery);
            $stmt->bindParam(':maSV', $maSV);
            $stmt->execute();
            $maDK = $this->conn->lastInsertId();

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


        $statusQuery = "SELECT TrangThai FROM DangKy WHERE MaSV = :maSV ORDER BY MaDK DESC LIMIT 1";
        $stmt = $this->conn->prepare($statusQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        $trangThai = $stmt->fetchColumn() ?? 'ChuaLuu';

        if ($trangThai === 'DaLuu') {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky?message=cannot_delete");
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

        $statusQuery = "SELECT TrangThai FROM DangKy WHERE MaSV = :maSV ORDER BY MaDK DESC LIMIT 1";
        $stmt = $this->conn->prepare($statusQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        $trangThai = $stmt->fetchColumn() ?? 'ChuaLuu';

        if ($trangThai === 'DaLuu') {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky?message=cannot_delete");
            exit();
        }


        $deleteQuery = "DELETE ctdk FROM ChiTietDangKy ctdk
                        JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                        WHERE dk.MaSV = :maSV";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();


        $deleteDangKyQuery = "DELETE FROM DangKy WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($deleteDangKyQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();

        header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky?message=deleted_all");
        exit();
    }

    public function save() {
        $maSV = $_SESSION['mssv'] ?? null;

        if (!$maSV) {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/auth/login");
            exit();
        }

    
        $query = "SELECT COUNT(*) 
                  FROM ChiTietDangKy ctdk
                  JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                  WHERE dk.MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky?message=no_items");
            exit();
        }

        $updateQuery = "UPDATE DangKy SET TrangThai = 'DaLuu' WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();

        header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/dangky?message=saved");
        exit();
    }
}
?>