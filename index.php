<?php
session_start();
require_once 'config_simple.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        // Handle registrasi
        if ($_POST['action'] == 'register') {
            try {
                $nama = $_POST['regName'];
                $email = $_POST['regEmail'];
                $password = password_hash($_POST['regPassword'], PASSWORD_DEFAULT);
                
                // Simple insert without prepared statement
                $sql = "INSERT INTO users (nama_lengkap, email, password) VALUES ('$nama', '$email', '$password')";
                
                if ($conn->query($sql)) {
                    $success = 'Registrasi berhasil! Silakan login.';
                } else {
                    $error = 'Error: ' . $conn->error;
                }
            } catch (Exception $e) {
                $error = 'Database error: ' . $e->getMessage();
            }
        }
    } else {
        // Handle login
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Simple login check
        if ($email == 'admin@apotek.com' && $password == 'admin123') {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = 'Administrator';
            header('Location: dashboard.php');
            exit();
        }
        
        // Database login
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($user = $result->fetch_assoc()) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_name'] = $user['nama_lengkap'];
                    header('Location: dashboard.php');
                    exit();
                }
            }
        } catch (Exception $e) {
            // Ignore database error
        }
        
        $error = 'Email atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NigApotek+</title>
    <link rel="stylesheet" href="css/sss.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="logo-section">
                <img src="assets/apot.jpeg" alt="Logo UT" class="logo">
                <h1>NigApotek+</h1>
                <p>Apotek Gaul Solusi Makin Cool</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div style="color: red; margin-bottom: 10px;"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (isset($success)): ?>
                <div style="color: green; margin-bottom: 10px;"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-options">
                    <button type="button" id="forgotPasswordBtn" class="link-btn">Lupa Password?</button>
                </div>
                
                <button type="submit" class="btn-primary">Masuk</button>
                
                <div class="register-section">
                    <p>Belum punya akun? <button type="button" id="registerBtn" class="link-btn">Daftar</button></p>
                    <p><small>Test: admin@apotek.com / admin123</small></p>
                    <p><a href='dashboard.php'>Skip to Dashboard</a> | <a href='register.php'>Test Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Lupa Password -->
    <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Lupa Password</h2>
            <form id="forgotPasswordForm">
                <div class="form-group">
                    <label for="resetEmail">Email</label>
                    <input type="email" id="resetEmail" name="resetEmail" required>
                </div>
                <button type="submit" class="btn-primary">Kirim Link Reset</button>
            </form>
        </div>
    </div>

    <!-- Modal Daftar -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Daftar Akun Baru</h2>
            <form method="POST">
                <input type="hidden" name="action" value="register">
                <div class="form-group">
                    <label for="regName">Nama Lengkap</label>
                    <input type="text" id="regName" name="regName" required>
                </div>
                <div class="form-group">
                    <label for="regEmail">Email</label>
                    <input type="email" id="regEmail" name="regEmail" required>
                </div>
                <div class="form-group">
                    <label for="regPassword">Password</label>
                    <input type="password" id="regPassword" name="regPassword" required>
                </div>
                <div class="form-group">
                    <label for="regConfirmPassword">Konfirmasi Password</label>
                    <input type="password" id="regConfirmPassword" name="regConfirmPassword" required>
                </div>
                <button type="submit" class="btn-primary">Daftar</button>
            </form>
        </div>
    </div>

    <script src="js/sc.js"></script>
</body>
</html>