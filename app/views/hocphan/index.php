<!DOCTYPE html>
<html lang="vi">
<head>
<?php require_once __DIR__ . '/../header.php'; ?>
    <meta charset="UTF-8">
    <title>Danh sách Học phần</title>
</head>
<body>
    <h2>Danh sách các Học phần</h2>
    <table border="1">
        <tr>
            <th>Mã HP</th>
            <th>Tên HP</th>
            <th>Số Tín Chỉ</th>
        </tr>
        <?php foreach ($hocPhanList as $hocPhan): ?>
            <tr>
                <td><?php echo htmlspecialchars($hocPhan['MaHP']); ?></td>
                <td><?php echo htmlspecialchars($hocPhan['TenHP']); ?></td>
                <td><?php echo htmlspecialchars($hocPhan['SoTinChi']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>