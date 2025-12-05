<?php
// Konfigurasi Database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'apotek_db';

try {
    // Membuat koneksi
    $conn = new mysqli($host, $username, $password, $database);
    
    // Cek koneksi
    if ($conn->connect_error) {
        throw new Exception("Koneksi gagal: " . $conn->connect_error);
    }
    
    // Set charset
    $conn->set_charset("utf8");
    
} catch (Exception $e) {
    // Jika database belum ada, redirect ke installer
    if (strpos($e->getMessage(), 'Unknown database') !== false) {
        if (!headers_sent()) {
            header('Location: create_db_manual.php');
            exit();
        }
    }
    die("Error database: " . $e->getMessage());
}
?>