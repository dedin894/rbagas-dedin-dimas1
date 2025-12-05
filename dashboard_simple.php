<?php
// Dashboard sederhana tanpa session check
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Dashboard - NigApotek+</title>";
echo "<link rel='stylesheet' href='css/sss.css'>";
echo "</head>";
echo "<body>";

echo "<h1>Dashboard NigApotek+</h1>";
echo "<p>Selamat datang di dashboard</p>";

// Test database connection
try {
    $conn = new mysqli('localhost', 'root', '', 'apotek_db');
    if ($conn->connect_error) {
        echo "<p style='color: red;'>Database belum terinstall</p>";
        echo "<a href='create_db_manual.php'>Install Database</a>";
    } else {
        echo "<p style='color: green;'>Database terhubung</p>";
        
        // Tampilkan data obat
        $result = $conn->query("SELECT * FROM obat LIMIT 3");
        if ($result && $result->num_rows > 0) {
            echo "<h3>Data Obat:</h3>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row['nama_obat'] . " - Stok: " . $row['stok'] . "</li>";
            }
            echo "</ul>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<a href='index.php'>Kembali ke Login</a> | ";
echo "<a href='stok.php'>Stok Obat</a> | ";
echo "<a href='laporan.php'>Laporan</a>";

echo "</body>";
echo "</html>";
?>