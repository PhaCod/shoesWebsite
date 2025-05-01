<?php
$error = '';

if (isset($_POST['login'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Trong ứng dụng thực tế, bạn sẽ kiểm tra thông tin đăng nhập từ cơ sở dữ liệu
    // Đây chỉ là ví dụ đơn giản
    
    // Kiểm tra tài khoản admin
    if ($email === 'admin@example.com' && $password === 'admin123') {
        // Thiết lập biến session cho admin
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = 'Admin';
        $_SESSION['user_email'] = $email;
        $_SESSION['is_admin'] = true;
        
        // Chuyển hướng đến trang admin
        header('Location: admin/index.php');
        exit;
    } 
    // Kiểm tra tài khoản người dùng thông thường
    else if ($email === 'user@example.com' && $password === 'password') {
        // Thiết lập biến session cho người dùng
        $_SESSION['user_id'] = 2;
        $_SESSION['user_name'] = 'John Doe';
        $_SESSION['user_email'] = $email;
        $_SESSION['is_admin'] = false;
        
        // Chuyển hướng đến trang chính
        header('Location: index.php');
        exit;
    } else {
        $error = 'Email hoặc mật khẩu không đúng';
    }
}
?>

<div class="form-container">
    <div class="form-title">
        <h2>Đăng nhập vào tài khoản của bạn</h2>
    </div>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="login" class="form-btn">Đăng nhập</button>
    </form>
    
    <div class="form-footer">
        <p>Chưa có tài khoản? <a href="index.php?page=register">Đăng ký</a></p>
        <div class="admin-login-info">
            <p><strong>Thông tin đăng nhập Admin:</strong></p>
            <p>Email: admin@example.com</p>
            <p>Mật khẩu: admin123</p>
        </div>
    </div>
</div>
