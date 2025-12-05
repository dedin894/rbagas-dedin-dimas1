<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_logged_in'])) {
    header('Location: index.php');
    exit();
}

// Ambil data laporan penjualan
$query = "SELECT 
    dt.id_obat,
    o.nama_obat,
    k.nama_kategori,
    SUM(dt.jumlah) as total_terjual,
    dt.harga_satuan,
    SUM(dt.subtotal) as total_penjualan
FROM detail_transaksi dt
JOIN obat o ON dt.id_obat = o.id_obat
LEFT JOIN kategori k ON o.id_kategori = k.id_kategori
GROUP BY dt.id_obat
ORDER BY total_terjual DESC";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - NigApotek+</title>
    <link rel="stylesheet" href="css/sss.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-left">
                <img src="assets/apot.jpeg" alt="Logo UT" class="logo">
                <h1>NigApotek+</h1>
            </div>
            <div class="header-right">
                <span id="greeting" class="greeting">Selamat datang, <?php echo $_SESSION['user_email']; ?></span>
                <a href="logout.php" class="btn-secondary">Keluar</a>
            </div>
        </header>

        <nav class="dashboard-nav">
            <ul>
                <li><a href="dashboard.php" class="nav-link">Dashboard</a></li>
                <li><a href="stok.php" class="nav-link">Stock Obat+</a></li>
                <li><a href="tracking.php" class="nav-link">Tracking Pengiriman Obat</a></li>
                <li class="dropdown">
                    <a href="laporan.php" class="nav-link active">Laporan</a>
                    <div class="dropdown-content">
                        <a href="laporan.php">Rekap Obat+</a>
                    </div>
                </li>
            </ul>
        </nav>

        <main class="stok-main">
            <div class="stok-header">
                <h2>Laporan Penjualan Obat</h2>
            </div>

            <table id="stockTable" class="stock-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Jenis</th>
                        <th>Jumlah Terjual</th>
                        <th>Harga Satuan</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()): 
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['nama_obat']; ?></td>
                        <td><?php echo $row['nama_kategori']; ?></td>
                        <td><?php echo $row['total_terjual']; ?></td>
                        <td>Rp <?php echo number_format($row['harga_satuan'], 0, ',', '.'); ?></td>
                        <td>Rp <?php echo number_format($row['total_penjualan'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Belum ada data penjualan</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>

    <script src="js/laporann.js"></script>
</body>
</html>