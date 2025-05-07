<?php require_once 'views/components/header.php'; ?>

<div class="section-title">
    <h2>My Account</h2>
</div>

<style>
    .account-form {
        max-width: 600px; /* Tăng chiều rộng để trông thoáng hơn */
        margin: 40px auto; /* Thêm khoảng cách từ đầu trang */
        padding: 30px;
        background-color: #ffffff; /* Màu nền sáng hơn */
        border-radius: 12px; /* Bo góc lớn hơn */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng mềm mại */
    }

    .account-form .form-group {
        margin-bottom: 20px; /* Tăng khoảng cách giữa các nhóm */
    }

    .account-form label {
        display: block;
        font-weight: 500; /* Font đậm vừa phải */
        color: #333; /* Màu chữ đậm hơn */
        margin-bottom: 8px; /* Khoảng cách nhỏ hơn giữa label và input */
    }

    .account-form input {
        width: 100%;
        padding: 12px; /* Tăng padding để dễ nhập */
        border: 2px solid #e0e0e0; /* Viền dày hơn và màu nhẹ */
        border-radius: 6px; /* Bo góc nhẹ */
        box-sizing: border-box;
        font-size: 16px; /* Kích thước chữ trong input */
        transition: border-color 0.3s ease; /* Hiệu ứng chuyển đổi màu viền */
    }

    .account-form input:focus {
        border-color: #007bff; /* Màu viền khi focus */
        outline: none; /* Loại bỏ outline mặc định */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3); /* Hiệu ứng glow */
    }

    .account-form button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        transition: background-color 0.3s ease; /* Hiệu ứng chuyển đổi màu nền */
    }

    .account-form button:hover {
        background-color: #0056b3; /* Màu nền khi hover */
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 6px;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="account-form">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($_SESSION['message']); ?>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($_SESSION['error']); ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username (cannot be changed)</label>
            <input type="text" id="username" value="<?php echo htmlspecialchars($user['Username']); ?>" disabled>
        </div>

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['Name'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['Email'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['Phone'] ?? ''); ?>" required>
        </div>

        <button type="submit">Update Information</button>
    </form>
</div>

<?php require_once 'views/components/footer.php'; ?>