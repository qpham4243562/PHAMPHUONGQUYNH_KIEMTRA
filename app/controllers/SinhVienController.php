<?php
require_once __DIR__ . '/../models/SinhVien.php';

class SinhVienController {
    private $sinhVien;

    public function __construct() {
        $this->sinhVien = new SinhVien();
    }

    public function index() {
        $sinhviens = $this->sinhVien->getAll();
        require_once __DIR__ . '/../views/sinhvien/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maSV = $_POST['maSV'];
            $hoTen = $_POST['hoTen'];
            $gioiTinh = $_POST['gioiTinh'];
            $ngaySinh = $_POST['ngaySinh'];
            $hinh = $_POST['hinh'];
            $maNganh = $_POST['maNganh'];

            if ($this->sinhVien->create($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh)) {
                header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien");
                exit();
            } else {
                echo "Thêm sinh viên thất bại!";
            }
        }
        require_once __DIR__ . '/../views/sinhvien/create.php';
    }

    public function edit($maSV) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoTen = $_POST['hoTen'];
            $gioiTinh = $_POST['gioiTinh'];
            $ngaySinh = $_POST['ngaySinh'];
            $hinh = $_POST['hinh'];
            $maNganh = $_POST['maNganh'];

            if ($this->sinhVien->update($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh)) {
                header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien");
                exit();
            } else {
                echo "Cập nhật thất bại!";
            }
        }
        $sinhvien = $this->sinhVien->getById($maSV);
        require_once __DIR__ . '/../views/sinhvien/edit.php';
    }

    public function delete($maSV) {
        if ($this->sinhVien->delete($maSV)) {
            header("Location: /PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien");
            exit();
        } else {
            echo "Xóa thất bại!";
        }
    }

    public function detail($maSV) {
        $sinhvien = $this->sinhVien->getById($maSV);
        require_once __DIR__ . '/../views/sinhvien/detail.php';
    }
}
?>