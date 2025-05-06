<?php
$host = '127.0.0.1';
$dbname = 'shoes';
$username = 'root'; // Thay đổi nếu bạn sử dụng tài khoản khác
$password = '123456789'; // Mật khẩu MySQL của bạn, mặc định là rỗng trên localhost

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
