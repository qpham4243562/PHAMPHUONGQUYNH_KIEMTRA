<!DOCTYPE html>
<html lang="vi">
<head>
    <?php require_once __DIR__ . '/../header.php'; ?>
    <meta charset="UTF-8">
    <title>Giỏ hàng - Học phần đã đăng ký</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-btn {
            margin-right: 10px;
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
        }
        .action-btn:hover {
            background-color: #c82333;
        }
        .clear-btn {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .clear-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h2>Giỏ hàng - Học phần đã đăng ký</h2>
    <?php if (isset($_GET['message']) && $_GET['message'] === 'deleted_all'): ?>
        <p style="color: green;">Đã xóa tất cả học phần thành công!</p>
    <?php endif; ?>
    <?php if (empty($dangKyList)): ?>
        <p>Bạn chưa đăng ký học phần nào.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Mã HP</th>
                <th>Tên HP</th>
                <th>Số Tín Chỉ</th>
                <th>Hành động</th>
            </tr>
            <?php foreach ($dangKyList as $dangKy): ?>
                <tr>
                    <td><?php echo htmlspecialchars($dangKy['MaHP']); ?></td>
                    <td><?php echo htmlspecialchars($dangKy['TenHP']); ?></td>
                    <td><?php echo htmlspecialchars($dangKy['SoTinChi']); ?></td>
                    <td>
                        <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/dangky/delete/<?php echo htmlspecialchars($dangKy['MaHP']); ?>" style="display:inline;">
                            <button type="submit" class="action-btn">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/dangky/deleteAll">
            <button type="submit" class="clear-btn" onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần đã đăng ký?')">Xóa tất cả</button>
        </form>
    <?php endif; ?>
</body>
</html>