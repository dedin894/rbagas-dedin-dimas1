<?php
// Test file untuk cek koneksi database dan tampilan
echo "<h1>Test NigApotek+</h1>";

// Test koneksi database
try {
    require_once 'config.php';
    echo "<p style='color: green;'>✓ Koneksi database berhasil!</p>";
    
    // Test query
    $result = $conn->query("SELECT COUNT(*) as total FROM obat");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p>Total obat di database: " . $row['total'] . "</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error database: " . $e->getMessage() . "</p>";
    echo "<p>Silakan jalankan install.php terlebih dahulu</p>";
}

// Test CSS
echo "<div style='margin-top: 20px;'>";
echo "<h3>Test CSS:</h3>";
echo "<link rel='stylesheet' href='css/sss.css'>";
echo "<div class='card'>";
echo "<h3>Test Card</h3>";
echo "<p>Jika card ini terlihat dengan styling yang benar, CSS sudah berfungsi</p>";
echo "</div>";
echo "</div>";

echo "<hr>";
echo "<h3>Langkah selanjutnya:</h3>";
echo "<ol>";
echo "<li><a href='install.php'>Install Database</a> (jika belum)</li>";
echo "<li><a href='index.php'>Login ke Aplikasi</a></li>";
echo "</ol>";
?>