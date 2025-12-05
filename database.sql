-- Database Apotek
CREATE DATABASE IF NOT EXISTS apotek_db;
USE apotek_db;

-- Tabel Kategori Obat
CREATE TABLE kategori (
    id_kategori INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(50) NOT NULL,
    deskripsi TEXT
);

-- Tabel Supplier
CREATE TABLE supplier (
    id_supplier INT PRIMARY KEY AUTO_INCREMENT,
    nama_supplier VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(50)
);

-- Tabel Obat
CREATE TABLE obat (
    id_obat INT PRIMARY KEY AUTO_INCREMENT,
    nama_obat VARCHAR(100) NOT NULL,
    id_kategori INT,
    id_supplier INT,
    harga_beli DECIMAL(10,2),
    harga_jual DECIMAL(10,2),
    stok INT DEFAULT 0,
    tanggal_kadaluarsa DATE,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori),
    FOREIGN KEY (id_supplier) REFERENCES supplier(id_supplier)
);

-- Tabel Transaksi Penjualan
CREATE TABLE transaksi (
    id_transaksi INT PRIMARY KEY AUTO_INCREMENT,
    tanggal_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_harga DECIMAL(10,2),
    nama_pelanggan VARCHAR(100),
    status VARCHAR(20) DEFAULT 'selesai'
);

-- Tabel Detail Transaksi
CREATE TABLE detail_transaksi (
    id_detail INT PRIMARY KEY AUTO_INCREMENT,
    id_transaksi INT,
    id_obat INT,
    jumlah INT,
    harga_satuan DECIMAL(10,2),
    subtotal DECIMAL(10,2),
    FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi),
    FOREIGN KEY (id_obat) REFERENCES obat(id_obat)
);

-- Tabel Stok Masuk
CREATE TABLE stok_masuk (
    id_stok_masuk INT PRIMARY KEY AUTO_INCREMENT,
    id_obat INT,
    jumlah INT,
    tanggal_masuk DATETIME DEFAULT CURRENT_TIMESTAMP,
    keterangan TEXT,
    FOREIGN KEY (id_obat) REFERENCES obat(id_obat)
);

-- Insert data sample
INSERT INTO kategori (nama_kategori, deskripsi) VALUES
('Tablet', 'Obat dalam bentuk tablet'),
('Sirup', 'Obat dalam bentuk sirup'),
('Kapsul', 'Obat dalam bentuk kapsul'),
('Salep', 'Obat luar dalam bentuk salep');

INSERT INTO supplier (nama_supplier, alamat, telepon, email) VALUES
('PT Kimia Farma', 'Jakarta', '021-1234567', 'info@kimiafarma.co.id'),
('PT Kalbe Farma', 'Bekasi', '021-7654321', 'info@kalbe.co.id'),
('PT Dexa Medica', 'Palembang', '0711-123456', 'info@dexa.co.id');

INSERT INTO obat (nama_obat, id_kategori, id_supplier, harga_beli, harga_jual, stok, tanggal_kadaluarsa, deskripsi) VALUES
('Paracetamol 500mg', 1, 1, 5000, 7000, 100, '2025-12-31', 'Obat penurun panas dan pereda nyeri'),
('Amoxicillin 500mg', 3, 2, 8000, 12000, 50, '2025-06-30', 'Antibiotik untuk infeksi bakteri'),
('OBH Combi', 2, 3, 15000, 20000, 30, '2025-09-15', 'Obat batuk dan flu'),
('Betadine Salep', 4, 1, 12000, 18000, 25, '2026-03-20', 'Antiseptik untuk luka luar');