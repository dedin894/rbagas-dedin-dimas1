<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_logged_in'])) {
    header('Location: index.php');
    exit();
}

// Data dummy untuk tracking
$tracking_data = [
    'DO001' => [
        'nama_pembeli' => 'John Doe',
        'status' => 'Dalam Perjalanan',
        'progress' => '75%',
        'ekspedisi' => 'JNE Express'
    ],
    'DO002' => [
        'nama_pembeli' => 'Jane Smith',
        'status' => 'Terkirim',
        'progress' => '100%',
        'ekspedisi' => 'Pos Indonesia'
    ],
    'DO003' => [
        'nama_pembeli' => 'Ahmad Rahman',
        'status' => 'Diproses',
        'progress' => '25%',
        'ekspedisi' => 'TIKI'
    ]
];

$search_result = null;
if (isset($_GET['do_number']) && !empty($_GET['do_number'])) {
    $do_number = $_GET['do_number'];
    if (isset($tracking_data[$do_number])) {
        $search_result = $tracking_data[$do_number];
        $search_result['do_number'] = $do_number;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Pengiriman - NigApotek+</title>
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
                <li><a href="tracking.php" class="nav-link active">Tracking Pengiriman Obat</a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link">Laporan</a>
                    <div class="dropdown-content">
                        <a href="laporan.php">Rekap Obat+</a>
                    </div>
                </li>
            </ul>
        </nav>

        <main class="tracking-main">
            <h2>Tracking Pengiriman</h2>
            
            <div class="tracking-form">
                <form method="GET">
                    <div class="form-group">
                        <label for="do_number">Nomor Delivery Order</label>
                        <input type="text" id="do_number" name="do_number" placeholder="Masukkan nomor DO" value="<?php echo isset($_GET['do_number']) ? $_GET['do_number'] : ''; ?>">
                    </div>
                    <button type="submit" class="btn-primary">Cari</button>
                </form>
            </div>
            
            <div id="trackingResult" class="tracking-result">
                <?php if ($search_result): ?>
                    <div class="result-card">
                        <h3>Hasil Pencarian</h3>
                        <p><strong>Nomor DO:</strong> <?php echo $search_result['do_number']; ?></p>
                        <p><strong>Nama Pembeli:</strong> <?php echo $search_result['nama_pembeli']; ?></p>
                        <p><strong>Status:</strong> <?php echo $search_result['status']; ?></p>
                        <p><strong>Progress:</strong> <?php echo $search_result['progress']; ?></p>
                        <p><strong>Ekspedisi:</strong> <?php echo $search_result['ekspedisi']; ?></p>
                    </div>
                <?php elseif (isset($_GET['do_number']) && !empty($_GET['do_number'])): ?>
                    <div class="result-card" style="color: red;">
                        <p>Nomor DO tidak ditemukan!</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tabel Data Dummy -->
            <div class="dummy-section">
                <h3>Data Dummy untuk Testing</h3>
                <p class="subtitle">Gunakan nomor DO berikut untuk mencoba fitur tracking:</p>
                
                <table class="stock-table dummy-table">
                    <thead>
                        <tr>
                            <th>Nomor DO</th>
                            <th>Nama Pembeli</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Ekspedisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tracking_data as $do => $data): ?>
                        <tr>
                            <td><?php echo $do; ?></td>
                            <td><?php echo $data['nama_pembeli']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td><?php echo $data['progress']; ?></td>
                            <td><?php echo $data['ekspedisi']; ?></td>
                            <td><a href="?do_number=<?php echo $do; ?>" class="btn-primary">Track</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div> 
    <script src="js/data.js"></script>
    <script src="js/sc.js"></script>
</body>   
</html>