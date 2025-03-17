<!DOCTYPE html>
<html>
<head>
<?php require_once __DIR__ . '/../header.php'; ?>
    <title>Thêm sinh viên</title>
</head>
<body>
    <h2>Thêm sinh viên</h2>
    <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien/create">
        <label>Mã SV: <input type="text" name="maSV" required></label><br>
        <label>Họ tên: <input type="text" name="hoTen" required></label><br>
        <label>Giới tính: 
            <select name="gioiTinh">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </label><br>
        <label>Ngày sinh: <input type="date" name="ngaySinh" required></label><br>
        <label>Hình: <input type="text" name="hinh" placeholder="Đường dẫn hình"></label><br>
        <label>Ngành: 
            <select name="maNganh">
                <option value="CNTT">CNTT</option>
                <option value="QTKD">QTKD</option>
            </select>
        </label><br>
        <button type="submit">Thêm</button>
    </form>
    <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien">Quay lại</a>
</body>
</html>