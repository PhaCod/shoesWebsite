<?php
require 'db_connect.php'; // Kết nối cơ sở dữ liệu


if (isset($_POST['login'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    if (empty($email) || empty($password)) {
        $error = 'Email and password are required';
    } else {
        try {
            // Kiểm tra trong bảng admin
            $stmt = $pdo->prepare("SELECT * FROM admin WHERE Email = ?");
            $stmt->execute([$email]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($admin && $password === $admin['Password']) {
                // Đăng nhập với tư cách admin
                $_SESSION['user_id'] = $admin['AdminID'];
                $_SESSION['user_name'] = $admin['Fname'] . ' ' . $admin['Lname'];
                $_SESSION['user_email'] = $admin['Email'];
                $_SESSION['role'] = 'admin';
                
                header('Location: admin/index.php'); // Chuyển hướng đến trang quản trị
                exit;
            }
            
            // Kiểm tra trong bảng member
            $stmt = $pdo->prepare("SELECT * FROM member WHERE Email = ?");
            $stmt->execute([$email]);
            $member = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($member && $password === $member['Password']) {
                // Đăng nhập với tư cách member
                $_SESSION['user_id'] = $member['MemberID'];
                $_SESSION['user_name'] = $member['Name'];
                $_SESSION['user_email'] = $member['Email'];
                $_SESSION['role'] = 'member';
                
                header('Location: index.php'); // Chuyển hướng đến trang chính
                exit;
            }
            
            $error = 'Invalid email or password';
        } catch (PDOException $e) {
            $error = 'Login failed: ' . $e->getMessage();
        }
    }
}
?>

<div class="form-container">
    <div class="form-title">
        <h2>Login to Your Account</h2>
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
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="login" class="form-btn">Login</button>
    </form>
    
    <div class="form-footer">
        <p>Don't have an account? <a href="index.php?page=register">Register</a></p>
    </div>
</div>