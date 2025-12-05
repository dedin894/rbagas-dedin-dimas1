<?php
session_start();

if ($_POST) {
    echo "<h3>Register Test</h3>";
    echo "<p>Nama: " . $_POST['regName'] . "</p>";
    echo "<p>Email: " . $_POST['regEmail'] . "</p>";
    echo "<p>Password: " . $_POST['regPassword'] . "</p>";
    
    try {
        $conn = new mysqli('localhost', 'root', '', 'apotek_db');
        
        if ($conn->connect_error) {
            echo "<p style='color: red;'>Database error: " . $conn->connect_error . "</p>";
        } else {
            $nama = $_POST['regName'];
            $email = $_POST['regEmail'];
            $password = password_hash($_POST['regPassword'], PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (nama_lengkap, email, password) VALUES ('$nama', '$email', '$password')";
            
            if ($conn->query($sql)) {
                echo "<p style='color: green;'>Registrasi berhasil!</p>";
                echo "<a href='index.php'>Login</a>";
            } else {
                echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
            }
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Exception: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<h3>Register Form</h3>";
    echo "<form method='POST'>";
    echo "<p>Nama: <input type='text' name='regName' required></p>";
    echo "<p>Email: <input type='email' name='regEmail' required></p>";
    echo "<p>Password: <input type='password' name='regPassword' required></p>";
    echo "<button type='submit'>Register</button>";
    echo "</form>";
}
?>