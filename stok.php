<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_logged_in'])) {
    header('Location: index.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $nama_obat = $_POST['namaBahan'];
        $stok = $_POST['stok'];
        $harga_jual = $_POST['harga_jual'];
        
        $query = "INSERT INTO obat (nama_obat, stok, harga_jual, id_kategori, id_supplier) VALUES (?, ?, ?, 1, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sid", $nama_obat, $stok, $harga_jual);
        $stmt->execute();
    }
}

// Ambil data obat
$query = "SELECT o.*, k.nama_kategori FROM obat o LEFT JOIN kategori k ON o.id_kategori = k.id_kategori ORDER BY o.id_obat DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Obat - NigApotek+</title>
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
                <li><a href="stok.php" class="nav-link active">Stock Obat+</a></li>
                <li><a href="tracking.php" class="nav-link">Tracking Pengiriman Obat</a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link">Laporan</a>
                    <div class="dropdown-content">
                        <a href="laporan.php">Rekap Obat+</a>
                    </div>
                </li>
            </ul>
        </nav>

        <main class="stok-main">
            <div class="stok-header">
                <h2>Informasi Stock Obat+</h2>
                <button id="addStockBtn" class="btn-primary">Tambah Stok</button>
            </div>
            
            <table id="stockTable" class="stock-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_obat']; ?></td>
                        <td><?php echo $row['nama_obat']; ?></td>
                        <td><?php echo $row['nama_kategori']; ?></td>
                        <td><?php echo $row['stok']; ?></td>
                        <td>Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                        <td>
                            <?php 
                            if ($row['stok'] > 10) echo '<span style="color: green;">Tersedia</span>';
                            elseif ($row['stok'] > 0) echo '<span style="color: orange;">Terbatas</span>';
                            else echo '<span style="color: red;">Habis</span>';
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>

    <!-- Modal Tambah Stok -->
    <div id="addStockModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Stok Baru</h2>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="namaBahan">Nama Obat</label>
                    <input type="text" id="namaBahan" name="namaBahan" required>
                </div>
                <div class="form-group">
                    <label for="stok">Jumlah Stok</label>
                    <input type="number" id="stok" name="stok" required>
                </div>
                <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" id="harga_jual" name="harga_jual" required>
                </div>
                <button type="submit" class="btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script src="js/data.js"></script>
    <script src="js/sc.js"></script>
</body>
</html>