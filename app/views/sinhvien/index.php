<!DOCTYPE html>
<html>
<head>
<?php require_once __DIR__ . '/../header.php'; ?>
    <title>Danh sách sinh viên</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Danh sách sinh viên</h2>
    <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien/create">Thêm sinh viên</a>
    <table>
        <tr>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Hình</th>
            <th>Ngành</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($sinhviens as $sv): ?>
        <tr>
            <td><?php echo htmlspecialchars($sv['MaSV']); ?></td>
            <td><?php echo htmlspecialchars($sv['HoTen']); ?></td>
            <td><?php echo htmlspecialchars($sv['GioiTinh']); ?></td>
            <td><?php echo htmlspecialchars($sv['NgaySinh']); ?></td>
            <td><?php echo htmlspecialchars($sv['Hinh']); ?></td>
            <td><?php echo htmlspecialchars($sv['MaNganh']); ?></td>
            <td>
                <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien/detail/<?php echo $sv['MaSV']; ?>">Xem</a> |
                <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien/edit/<?php echo $sv['MaSV']; ?>">Sửa</a> |
                <a href="/PHAMPHUONGQUYNH_KIEMTRA/public/sinhvien/delete/<?php echo $sv['MaSV']; ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>