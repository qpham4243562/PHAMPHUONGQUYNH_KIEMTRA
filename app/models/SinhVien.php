<?php
require_once __DIR__ . '/../config/database.php';

class SinhVien {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($maSV) {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien WHERE MaSV = :maSV");
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        $stmt = $this->conn->prepare("INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (:maSV, :hoTen, :gioiTinh, :ngaySinh, :hinh, :maNganh)");
        $stmt->bindParam(':maSV', $maSV);
        $stmt->bindParam(':hoTen', $hoTen);
        $stmt->bindParam(':gioiTinh', $gioiTinh);
        $stmt->bindParam(':ngaySinh', $ngaySinh);
        $stmt->bindParam(':hinh', $hinh);
        $stmt->bindParam(':maNganh', $maNganh);
        return $stmt->execute();
    }

    public function update($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        $stmt = $this->conn->prepare("UPDATE SinhVien SET HoTen = :hoTen, GioiTinh = :gioiTinh, NgaySinh = :ngaySinh, Hinh = :hinh, MaNganh = :maNganh WHERE MaSV = :maSV");
        $stmt->bindParam(':maSV', $maSV);
        $stmt->bindParam(':hoTen', $hoTen);
        $stmt->bindParam(':gioiTinh', $gioiTinh);
        $stmt->bindParam(':ngaySinh', $ngaySinh);
        $stmt->bindParam(':hinh', $hinh);
        $stmt->bindParam(':maNganh', $maNganh);
        return $stmt->execute();
    }

    public function delete($maSV) {
        $stmt = $this->conn->prepare("DELETE FROM SinhVien WHERE MaSV = :maSV");
        $stmt->bindParam(':maSV', $maSV);
        return $stmt->execute();
    }
}
?>