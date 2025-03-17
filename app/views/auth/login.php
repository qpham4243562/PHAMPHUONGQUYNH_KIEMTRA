<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>
<body>
    <?php require_once __DIR__ . '/../header.php'; ?> 
    <h2>Đăng nhập</h2>
    <form method="POST" action="/PHAMPHUONGQUYNH_KIEMTRA/public/auth/login">
        <label>MSSV:</label><br>
        <input type="text" name="mssv" required><br><br>
        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;">MSSV không đúng!</p>
        <?php endif; ?>
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>