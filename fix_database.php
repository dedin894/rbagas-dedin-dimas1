<?php
echo "<h2>Fix Database - Tambah Tabel Users</h2>";

$conn = new mysqli('localhost', 'root', '', 'apotek_db');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Buat tabel users
$sql = "CREATE TABLE IF NOT EXISTS users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Tabel users berhasil dibuat</p>";
} else {
    echo "<p style='color: red;'>✗ Error: " . $conn->error . "</p>";
}

// Insert admin default
$admin_password = password_hash('admin123', PASSWORD_DEFAULT);
$sql = "INSERT IGNORE INTO users (id_user, nama_lengkap, email, password, role) VALUES
(1, 'Administrator', 'admin@apotek.com', '$admin_password', 'admin')";

if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Admin default berhasil dibuat</p>";
} else {
    echo "<p style='color: red;'>✗ Error: " . $conn->error . "</p>";
}

// Test tabel users
$result = $conn->query("SELECT * FROM users");
if ($result->num_rows > 0) {
    echo "<h3>Data Users:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_user'] . "</td>";
        echo "<td>" . $row['nama_lengkap'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

echo "<h3 style='color: blue;'>Database sudah diperbaiki!</h3>";
echo "<p><a href='index.php'>Login ke Aplikasi</a></p>";

$conn->close();
?>