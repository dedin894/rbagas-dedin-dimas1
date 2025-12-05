<?php
// Konfigurasi Database Sederhana
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'apotek_db';

// Coba koneksi
$conn = @new mysqli($host, $username, $password, $database);

// Jika database belum ada, buat dulu
if ($conn->connect_error) {
    // Koneksi tanpa database untuk buat database
    $conn = new mysqli($host, $username, $password);
    $conn->query("CREATE DATABASE IF NOT EXISTS apotek_db");
    $conn->select_db('apotek_db');
}

$conn->set_charset("utf8");
?>