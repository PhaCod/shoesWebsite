<?php
require 'db_connect.php'; // Kết nối cơ sở dữ liệu


if (isset($_POST['register'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    
    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'All fields are required';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long';
    } else {
        try {
            // Kiểm tra xem email đã tồn tại chưa
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM member WHERE Email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() > 0) {
                $error = 'Email already exists';
            } else {
                // Mã hóa mật khẩu
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Thêm người dùng mới vào bảng member
                $stmt = $pdo->prepare("INSERT INTO member (Username, Password, Name, Email, AdminID) VALUES (?, ?, ?, ?, ?)");
                $username = explode('@', $email)[0]; // Tạo username từ phần đầu của email
                $admin_id = 1; // Giả sử AdminID mặc định là 1, bạn có thể thay đổi logic này
                $stmt->execute([$username, $hashed_password, $name, $email, $admin_id]);
                
                $success = 'Registration successful! You can now login.';
                // Chuyển hướng sau 3 giây
                header('Refresh: 3; URL=index.php?page=login');
            }
        } catch (PDOException $e) {
            $error = 'Registration failed: ' . $e->getMessage();
        }
    }
}
?>

<div class="form-container">
    <div class="form-title">
        <h2>Create an Account</h2>
    </div>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" name="register" class="form-btn">Register</button>
    </form>
    
    <div class="form-footer">
        <p>Already have an account? <a href="index.php?page=login">Login</a></p>
    </div>
</div>