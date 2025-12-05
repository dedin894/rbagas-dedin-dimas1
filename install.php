<?php
// File untuk instalasi database otomatis
$host = 'localhost';
$username = 'root';
$password = '';

// Koneksi tanpa database
$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Baca file SQL
$sql = file_get_contents('database.sql');

// Pisahkan query berdasarkan semicolon
$queries = explode(';', $sql);

echo "<h2>Instalasi Database Apotek</h2>";
echo "<div style='font-family: Arial; padding: 20px;'>";

foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if ($conn->query($query)) {
            echo "<p style='color: green;'>✓ Query berhasil dijalankan</p>";
        } else {
            echo "<p style='color: red;'>✗ Error: " . $conn->error . "</p>";
        }
    }
}

echo "<h3 style='color: blue;'>Database berhasil diinstal!</h3>";
echo "<p>Anda dapat mengakses aplikasi sekarang.</p>";
echo "</div>";

$conn->close();
?>