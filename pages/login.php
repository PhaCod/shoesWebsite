<?php
$error = '';

if (isset($_POST['login'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // In a real application, you would validate against a database
    // This is just a simple example
    if ($email === 'user@example.com' && $password === 'password') {
        // Set session variables
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = 'John Doe';
        $_SESSION['user_email'] = $email;
        
        // Redirect to home page
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid email or password';
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

