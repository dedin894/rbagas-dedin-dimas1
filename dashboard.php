<?php
error_reporting(0);

try {
    session_start();
    require_once 'config_simple.php';
    
    // Skip session check untuk debugging
    // if (!isset($_SESSION['user_logged_in'])) {
    //     header('Location: index.php');
    //     exit();
    // }
    
    // Set default values
    $total_obat = 0;
    $stok_rendah = 0;
    $total_transaksi = 0;
    
    // Ambil statistik dari database
    if (isset($conn)) {
        $result = $conn->query("SELECT COUNT(*) as total FROM obat");
        if ($result) $total_obat = $result->fetch_assoc()['total'];
        
        $result = $conn->query("SELECT COUNT(*) as total FROM obat WHERE stok < 10");
        if ($result) $stok_rendah = $result->fetch_assoc()['total'];
        
        $result = $conn->query("SELECT COUNT(*) as total FROM transaksi");
        if ($result) $total_transaksi = $result->fetch_assoc()['total'];
    }
} catch (Exception $e) {
    $total_obat = 0;
    $stok_rendah = 0;
    $total_transaksi = 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NigApotek+</title>
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
                <span id="greeting" class="greeting">Selamat datang, <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User'; ?></span>
                <a href="logout.php" class="btn-secondary">Keluar</a>
            </div>
        </header>

        <nav class="dashboard-nav">
            <ul>
                <li><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
                <li><a href="stok.php" class="nav-link">Stock Obat+</a></li>
                <li><a href="tracking.php" class="nav-link">Tracking Pengiriman Obat</a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link">Laporan</a>
                    <div class="dropdown-content">
                        <a href="laporan.php">Rekap Obat+</a>
                    </div>
                </li>
            </ul>
        </nav>

        <main class="dashboard-main">
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3>Total Obat</h3>
                    <p class="stat-number"><?php echo $total_obat; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Stok Rendah</h3>
                    <p class="stat-number"><?php echo $stok_rendah; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Transaksi</h3>
                    <p class="stat-number"><?php echo $total_transaksi; ?></p>
                </div>
            </div>
            
            <div class="dashboard-cards">
                <div class="card">
                    <h3>Stock Obat</h3>
                    <img src="assets/oabt1.jpeg" alt="Stock Icon" class="card-gambar">
                    <p>Kelola dan lihat Stock Obat</p>
                    <a href="stok.php" class="btn-primary">Lihat</a>
                </div>
                
                <div class="card">
                    <h3>Tracking Pengiriman</h3>
                    <img src="assets/rir.jpg" alt="Tracking Icon" class="card-gambar">
                    <p>Lacak status pengiriman Obat</p>
                    <a href="tracking.php" class="btn-primary">Lacak</a>
                </div>
                
                <div class="card">
                    <h3>Laporan</h3>
                    <img src="assets/por.jpg" alt="Laporan Icon" class="card-gambar">
                    <p>Monitoring progress dan rekap penjualan Obat</p>
                    <a href="laporan.php" class="btn-primary">Lihat</a>
                </div>
            </div>
        </main>
    </div>

    <script src="js/sc.js"></script>
</body>
</html>