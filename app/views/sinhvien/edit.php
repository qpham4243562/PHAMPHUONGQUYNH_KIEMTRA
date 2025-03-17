<!DOCTYPE html>
<html>
<head>
<?php require_once __DIR__ . '/../header.php'; ?>
    <title>Sửa sinh viên</title>
</head>
<body>
    <h2>Sửa sinh viên</h2>
    <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien/edit/<?php echo htmlspecialchars($sinhvien['MaSV']); ?>">
        <label>Họ tên: <input type="text" name="hoTen" value="<?php echo htmlspecialchars($sinhvien['HoTen']); ?>" required></label><br>
        <label>Giới tính: 
            <select name="gioiTinh">
                <option value="Nam" <?php if($sinhvien['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                <option value="Nữ" <?php if($sinhvien['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
            </select>
        </label><br>
        <label>Ngày sinh: <input type="date" name="ngaySinh" value="<?php echo htmlspecialchars($sinhvien['NgaySinh']); ?>" required></label><br>
        <label>Hình: <input type="text" name="hinh" value="<?php echo htmlspecialchars($sinhvien['Hinh']); ?>"></label><br>
        <label>Ngành: 
            <select name="maNganh">
                <option value="CNTT" <?php if($sinhvien['MaNganh'] == 'CNTT') echo 'selected'; ?>>CNTT</option>
                <option value="QTKD" <?php if($sinhvien['MaNganh'] == 'QTKD') echo 'selected'; ?>>QTKD</option>
            </select>
        </label><br>
        <button type="submit">Cập nhật</button>
    </form>
    <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien">Quay lại</a>
</body>
</html>