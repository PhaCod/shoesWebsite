<?php
// Thông tin kết nối cơ sở dữ liệu
$host = '127.0.0.1';
$dbname = 'shoe';
$username = 'root'; // Thay đổi nếu bạn sử dụng tài khoản khác
$password = ''; // Mật khẩu MySQL của bạn, mặc định là rỗng trên localhost

try {
    // Kết nối với MySQL sử dụng PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Thiết lập chế độ báo lỗi
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>