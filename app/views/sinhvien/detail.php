<!DOCTYPE html>
<html>
<head>
<?php require_once __DIR__ . '/../header.php'; ?>
    <title>Chi tiết sinh viên</title>
</head>
<body>
    <h2>Chi tiết sinh viên</h2>
    <p>Mã SV: <?php echo htmlspecialchars($sinhvien['MaSV']); ?></p>
    <p>Họ tên: <?php echo htmlspecialchars($sinhvien['HoTen']); ?></p>
    <p>Giới tính: <?php echo htmlspecialchars($sinhvien['GioiTinh']); ?></p>
    <p>Ngày sinh: <?php echo htmlspecialchars($sinhvien['NgaySinh']); ?></p>
    <p>Hình: <?php echo htmlspecialchars($sinhvien['Hinh']); ?></p>
    <p>Ngành: <?php echo htmlspecialchars($sinhvien['MaNganh']); ?></p>
    <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien">Quay lại</a>
</body>
</html>