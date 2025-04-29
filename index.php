<?php
session_start();

// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "bills_reminder";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Helper function to render HTML content
function renderHTML($file) {
    ob_start();
    include $file;
    return ob_get_clean();
}

// Routes
$page = isset($_GET['page']) ? $_GET['page'] : 'index';

switch ($page) {
    case 'dashboard':
        $content = renderHTML('dashboard.html');
        break;
    case 'add-wallet':
        $content = renderHTML('add-wallet.html');
        break;
    case 'customer-service':
        $content = renderHTML('customer-service.html');
        break;
    case 'daftar-tagihan':
        $content = renderHTML('daftar-tagihan.html');
        break;
    case 'grafik-statistik':
        $content = renderHTML('grafik-statistik.html');
        break;
    case 'index':
        $content = renderHTML('index.html');
        break;
    case 'kalendertagihan':
        $content = renderHTML('kalendertagihan.html');
        break;
    case 'notifications':
        $content = renderHTML('notifications.html');
        break;
    case 'pemasukan':
        $content = renderHTML('pemasukan.html');
        break;
    case 'pengeluaran':
        $content = renderHTML('pengeluaran.html');
        break;
    case 'profile':
        $content = renderHTML('profile.html');
        break;
    case 'tambah-tagihan':
        $content = renderHTML('tambah-tagihan.html');
        break;
    case 'wallets':
        $content = renderHTML('wallets.html');
        break;
    default:
        $content = '<h1>404 Not Found</h1>';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills Reminder</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 70px;
        }
        
        .navbar {
            background-color: #0d6efd;
            padding: 10px 20px;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        
        footer {
            background-color: #0d6efd;
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }
        
        .container-footer {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .footer-link {
            color: white;
            text-decoration: none;
        }
        
        .footer-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="?page=index">Bills Reminder</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tagihanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tagihan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tagihanDropdown">
                            <li><a class="dropdown-item" href="?page=tambah-tagihan">Tambah Tagihan</a></li>
                            <li><a class="dropdown-item" href="?page=daftar-tagihan">Daftar Tagihan</a></li>
                            <li><a class="dropdown-item" href="?page=kalendertagihan">Kalender Tagihan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="keuanganDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Keuangan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="keuanganDropdown">
                            <li><a class="dropdown-item" href="?page=add-wallet">Add Wallet</a></li>
                            <li><a class="dropdown-item" href="?page=wallets">My Wallets</a></li>
                            <li><a class="dropdown-item" href="?page=pemasukan">Pemasukan</a></li>
                            <li><a class="dropdown-item" href="?page=pengeluaran">Pengeluaran</a></li>
                            <li><a class="dropdown-item" href="?page=grafik-statistik">Grafik & Statistik</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=customer-service">Customer Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" title="Notifikasi"><i class="fas fa-bell"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=profile">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <?php echo $content; ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container-footer">
            <h5>Hubungi Kami :</h5>
            <p>
                <i class="fas fa-phone"></i> +62 82164642828 (WhatsApp Only)<br>
                <i class="fas fa-envelope"></i> support@billreminder.id<br>
                <i class="fas fa-map-marker-alt"></i> UNIVERSITAS PELITA HARAPAN<br>
                Lippo Plaza Medan, Jl. Imam Bonjol No.6 Lantai 5 - 7, Petisah Tengah, Medan Petisah, Medan City, North Sumatra 20112
            </p>
            <p>
                <a href="https://wa.me/6282164642828" class="footer-link" target="_blank">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>