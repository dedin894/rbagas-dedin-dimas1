<?php
// Manual database creation
$host = 'localhost';
$username = 'root';
$password = '';

// Koneksi tanpa database
$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "<h2>Membuat Database Manual</h2>";

// Buat database
$sql = "CREATE DATABASE IF NOT EXISTS apotek_db";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Database apotek_db berhasil dibuat</p>";
} else {
    echo "<p style='color: red;'>✗ Error: " . $conn->error . "</p>";
}

// Pilih database
$conn->select_db('apotek_db');

// Buat tabel kategori
$sql = "CREATE TABLE IF NOT EXISTS kategori (
    id_kategori INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(50) NOT NULL,
    deskripsi TEXT
)";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Tabel kategori berhasil dibuat</p>";
}

// Buat tabel supplier
$sql = "CREATE TABLE IF NOT EXISTS supplier (
    id_supplier INT PRIMARY KEY AUTO_INCREMENT,
    nama_supplier VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(50)
)";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Tabel supplier berhasil dibuat</p>";
}

// Buat tabel obat
$sql = "CREATE TABLE IF NOT EXISTS obat (
    id_obat INT PRIMARY KEY AUTO_INCREMENT,
    nama_obat VARCHAR(100) NOT NULL,
    id_kategori INT,
    id_supplier INT,
    harga_beli DECIMAL(10,2),
    harga_jual DECIMAL(10,2),
    stok INT DEFAULT 0,
    tanggal_kadaluarsa DATE,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Tabel obat berhasil dibuat</p>";
}

// Buat tabel transaksi
$sql = "CREATE TABLE IF NOT EXISTS transaksi (
    id_transaksi INT PRIMARY KEY AUTO_INCREMENT,
    tanggal_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_harga DECIMAL(10,2),
    nama_pelanggan VARCHAR(100),
    status VARCHAR(20) DEFAULT 'selesai'
)";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Tabel transaksi berhasil dibuat</p>";
}

// Buat tabel detail_transaksi
$sql = "CREATE TABLE IF NOT EXISTS detail_transaksi (
    id_detail INT PRIMARY KEY AUTO_INCREMENT,
    id_transaksi INT,
    id_obat INT,
    jumlah INT,
    harga_satuan DECIMAL(10,2),
    subtotal DECIMAL(10,2)
)";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Tabel detail_transaksi berhasil dibuat</p>";
}

// Insert data kategori
$sql = "INSERT IGNORE INTO kategori (id_kategori, nama_kategori, deskripsi) VALUES
(1, 'Tablet', 'Obat dalam bentuk tablet'),
(2, 'Sirup', 'Obat dalam bentuk sirup'),
(3, 'Kapsul', 'Obat dalam bentuk kapsul'),
(4, 'Salep', 'Obat luar dalam bentuk salep')";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Data kategori berhasil dimasukkan</p>";
}

// Insert data supplier
$sql = "INSERT IGNORE INTO supplier (id_supplier, nama_supplier, alamat, telepon, email) VALUES
(1, 'PT Kimia Farma', 'Jakarta', '021-1234567', 'info@kimiafarma.co.id'),
(2, 'PT Kalbe Farma', 'Bekasi', '021-7654321', 'info@kalbe.co.id'),
(3, 'PT Dexa Medica', 'Palembang', '0711-123456', 'info@dexa.co.id')";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Data supplier berhasil dimasukkan</p>";
}

// Buat tabel users untuk registrasi
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
}

// Insert admin default
$admin_password = password_hash('admin123', PASSWORD_DEFAULT);
$sql = "INSERT IGNORE INTO users (id_user, nama_lengkap, email, password, role) VALUES
(1, 'Administrator', 'admin@apotek.com', '$admin_password', 'admin')";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Admin default berhasil dibuat</p>";
}

// Insert data obat
$sql = "INSERT IGNORE INTO obat (id_obat, nama_obat, id_kategori, id_supplier, harga_beli, harga_jual, stok, tanggal_kadaluarsa, deskripsi) VALUES
(1, 'Paracetamol 500mg', 1, 1, 5000, 7000, 100, '2025-12-31', 'Obat penurun panas dan pereda nyeri'),
(2, 'Amoxicillin 500mg', 3, 2, 8000, 12000, 50, '2025-06-30', 'Antibiotik untuk infeksi bakteri'),
(3, 'OBH Combi', 2, 3, 15000, 20000, 30, '2025-09-15', 'Obat batuk dan flu'),
(4, 'Betadine Salep', 4, 1, 12000, 18000, 25, '2026-03-20', 'Antiseptik untuk luka luar')";
if ($conn->query($sql)) {
    echo "<p style='color: green;'>✓ Data obat berhasil dimasukkan</p>";
}

echo "<h3 style='color: blue;'>Database berhasil dibuat!</h3>";
echo "<p><a href='index.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Login ke Aplikasi</a></p>";

$conn->close();
?>