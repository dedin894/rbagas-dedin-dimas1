<?php
echo "<h1>Debug NigApotek+</h1>";

// Test PHP
echo "<h3>1. PHP Status:</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

// Test CSS
echo "<h3>2. CSS Test:</h3>";
echo '<link rel="stylesheet" href="css/sss.css">';
echo '<div class="login-container" style="height: 200px;">';
echo '<div class="login-form">';
echo '<h3>Test CSS - Jika ini terlihat dengan styling, CSS berfungsi</h3>';
echo '</div>';
echo '</div>';

// Test Database
echo "<h3>3. Database Test:</h3>";
try {
    $conn = new mysqli('localhost', 'root', '', 'apotek_db');
    if ($conn->connect_error) {
        echo "<p style='color: red;'>Database belum ada - <a href='create_db_manual.php'>Install Database</a></p>";
    } else {
        echo "<p style='color: green;'>Database OK</p>";
        $result = $conn->query("SELECT COUNT(*) as total FROM users");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p>Total users: " . $row['total'] . "</p>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

// Test Files
echo "<h3>4. File Test:</h3>";
$files = ['index.php', 'css/sss.css', 'assets/apot.jpeg'];
foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p style='color: green;'>✓ $file exists</p>";
    } else {
        echo "<p style='color: red;'>✗ $file missing</p>";
    }
}

echo "<hr>";
echo "<h3>Links:</h3>";
echo "<p><a href='index.php'>Go to Login Page</a></p>";
echo "<p><a href='create_db_manual.php'>Install Database</a></p>";
?>