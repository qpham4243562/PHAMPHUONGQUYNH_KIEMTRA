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
        .save-btn {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }
        .save-btn:hover {
            background-color: #0056b3;
        }
        .disabled {
            background-color: #ccc !important;
            cursor: not-allowed !important;
        }
    </style>
</head>
<body>
    <h2>Giỏ hàng - Học phần đã đăng ký</h2>
    <?php if (isset($_GET['message'])): ?>
        <?php if ($_GET['message'] === 'deleted_all'): ?>
            <p style="color: green;">Đã xóa tất cả học phần thành công!</p>
        <?php elseif ($_GET['message'] === 'no_items'): ?>
            <p style="color: red;">Không có học phần nào để xóa!</p>
        <?php elseif ($_GET['message'] === 'saved'): ?>
            <p style="color: green;">Đăng ký thành công!</p>
        <?php elseif ($_GET['message'] === 'cannot_delete'): ?>
            <p style="color: red;">Không thể xóa vì đăng ký đã được lưu!</p>
        <?php elseif ($_GET['message'] === 'already_saved'): ?>
            <p style="color: red;">Đăng ký đã được lưu, không thể thêm học phần mới!</p>
        <?php endif; ?>
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
                            <button type="submit" class="action-btn <?php echo $trangThai === 'DaLuu' ? 'disabled' : ''; ?>" <?php echo $trangThai === 'DaLuu' ? 'disabled' : ''; ?>>Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/dangky/deleteAll" style="display:inline;">
            <button type="submit" class="clear-btn <?php echo $trangThai === 'DaLuu' ? 'disabled' : ''; ?>" <?php echo $trangThai === 'DaLuu' ? 'disabled' : ''; ?> onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần đã đăng ký?')">Xóa tất cả</button>
        </form>
        <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/dangky/save" style="display:inline;">
            <button type="submit" class="save-btn" onclick="return confirm('Bạn có chắc muốn lưu đăng ký?')">Lưu đăng ký</button>
        </form>
    <?php endif; ?>
</body>
</html>