<?php
echo "<h3>Check Users Table</h3>";

try {
    $conn = new mysqli('localhost', 'root', '', 'apotek_db');
    
    if ($conn->connect_error) {
        echo "<p style='color: red;'>Database connection failed</p>";
        echo "<a href='create_db_manual.php'>Create Database</a>";
    } else {
        echo "<p style='color: green;'>Database connected</p>";
        
        // Check if users table exists
        $result = $conn->query("SHOW TABLES LIKE 'users'");
        if ($result->num_rows > 0) {
            echo "<p style='color: green;'>Users table exists</p>";
            
            // Show all users
            $result = $conn->query("SELECT * FROM users");
            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Nama</th><th>Email</th><th>Created</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_user'] . "</td>";
                    echo "<td>" . $row['nama_lengkap'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No users found</p>";
            }
        } else {
            echo "<p style='color: red;'>Users table not found</p>";
            echo "<a href='create_db_manual.php'>Create Database</a>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<a href='index.php'>Back to Login</a> | <a href='register.php'>Test Register</a>";
?>