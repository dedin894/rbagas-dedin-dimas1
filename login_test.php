<?php
session_start();

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    echo "<h3>Login Test</h3>";
    echo "<p>Email: $email</p>";
    echo "<p>Password: $password</p>";
    
    if ($email == 'admin@apotek.com' && $password == 'admin123') {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = 'Administrator';
        
        echo "<p style='color: green;'>Login berhasil!</p>";
        echo "<a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "<p style='color: red;'>Login gagal!</p>";
    }
    
    echo "<hr>";
    echo "<a href='index.php'>Back to Login</a>";
} else {
    echo "<h3>Direct Login Test</h3>";
    echo "<form method='POST'>";
    echo "<p>Email: <input type='email' name='email' value='admin@apotek.com'></p>";
    echo "<p>Password: <input type='password' name='password' value='admin123'></p>";
    echo "<button type='submit'>Test Login</button>";
    echo "</form>";
}
?>