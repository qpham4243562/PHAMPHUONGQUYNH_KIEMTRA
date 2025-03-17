<!DOCTYPE html>
<html>
<head>
<?php require_once __DIR__ . '/../header.php'; ?>
    <title>Xóa sinh viên</title>
</head>
<body>
    <h2>Xác nhận xóa</h2>
    <p>Bạn có chắc chắn muốn xóa sinh viên <?php echo htmlspecialchars($sinhvien['HoTen']); ?>?</p>
    <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien/delete/<?php echo htmlspecialchars($sinhvien['MaSV']); ?>">
        <button type="submit">Xóa</button>
        <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien">Hủy</a>
    </form>
</body>
</html>