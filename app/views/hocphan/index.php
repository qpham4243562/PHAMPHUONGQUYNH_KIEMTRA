<!DOCTYPE html>
<html lang="vi">
<head>
    <?php require_once __DIR__ . '/../header.php'; ?>
    <meta charset="UTF-8">
    <title>Danh sách Học phần</title>
</head>
<body>
    <h2>Danh sách các Học phần</h2>
    <?php if (isset($_GET['message']) && $_GET['message'] === 'no_slots'): ?>
        <p style="color: red;">Học phần đã hết chỗ!</p>
    <?php endif; ?>
    <table border="1">
        <tr>
            <th>Mã HP</th>
            <th>Tên HP</th>
            <th>Số Tín Chỉ</th>
            <th>Số lượng dự kiến</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($hocPhanList as $hocPhan): ?>
            <tr>
                <td><?php echo htmlspecialchars($hocPhan['MaHP']); ?></td>
                <td><?php echo htmlspecialchars($hocPhan['TenHP']); ?></td>
                <td><?php echo htmlspecialchars($hocPhan['SoTinChi']); ?></td>
                <td><?php echo htmlspecialchars($hocPhan['SoLuongDuKien']); ?></td>
                <td>
                    <?php if ($hocPhan['SoLuongDuKien'] > 0): ?>
                        <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/dangky/add/<?php echo htmlspecialchars($hocPhan['MaHP']); ?>" style="display:inline;">
                            <button type="submit">Đăng ký</button>
                        </form>
                    <?php else: ?>
                        <button disabled>Hết chỗ</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>