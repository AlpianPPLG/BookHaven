<?php
// =========================
// Dashboard utama Admin
// Menampilkan statistik dan menu utama admin
// =========================
session_start();

// Cek apakah admin sudah login
if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../sign/admin/sign_in.php");
  exit;
}

// Include konfigurasi database
require_once '../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>BookHaven - Admin Dashboard</title>
    <style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --secondary: #3f37c9;
        --success: #4ade80;
        --success-dark: #22c55e;
        --danger: #ef4444;
        --warning: #f59e0b;
        --info: #3b82f6;
        --light: #f3f4f6;
        --dark: #1f2937;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --sidebar-width: 250px;
        --topbar-height: 70px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
        color: var(--gray-800);
        overflow-x: hidden;
    }

    /* Sidebar Styles */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: var(--sidebar-width);
        background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        z-index: 1000;
        transition: all 0.3s ease;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .sidebar-header {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-sidebar {
        position: absolute;
        right: 15px;
        top: 20px;
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
        opacity: 0.8;
        display: none;
    }

    .close-sidebar:hover {
        background-color: rgba(255, 255, 255, 0.1);
        opacity: 1;
    }

    @media (max-width: 992px) {
        .close-sidebar {
            display: flex;
        }
    }

    .sidebar-logo {
        max-width: 150px;
        height: auto;
        margin-bottom: 10px;
    }

    .sidebar-menu {
        padding: 20px 0;
    }

    .menu-header {
        padding: 10px 25px;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, 0.6);
    }

    .menu-item {
        padding: 12px 25px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.8);
        border-left: 3px solid transparent;
    }

    .menu-item:hover,
    .menu-item.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border-left: 3px solid white;
    }

    .menu-item i {
        margin-right: 10px;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }

    .menu-text {
        font-weight: 500;
    }

    /* Main Content Styles */
    .main-content {
        margin-left: var(--sidebar-width);
        padding-top: var(--topbar-height);
        min-height: 100vh;
        transition: all 0.3s ease;
        padding-bottom: 70px;
        /* Space for footer */
    }

    /* Topbar Styles */
    .topbar {
        position: fixed;
        top: 0;
        left: var(--sidebar-width);
        right: 0;
        height: var(--topbar-height);
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;
        z-index: 999;
        transition: all 0.3s ease;
    }

    .toggle-sidebar {
        background: none;
        border: none;
        color: var(--gray-600);
        font-size: 1.5rem;
        cursor: pointer;
        display: none;
    }

    .topbar-title {
        font-weight: 600;
        color: var(--gray-800);
    }

    .user-dropdown {
        position: relative;
    }

    .user-dropdown-toggle {
        background: none;
        border: none;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .user-dropdown-toggle:hover {
        background-color: var(--gray-100);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary);
    }

    .user-name {
        font-weight: 500;
        color: var(--gray-800);
    }

    .user-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        width: 250px;
        padding: 15px;
        margin-top: 10px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .user-dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .user-dropdown-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--gray-200);
        margin-bottom: 15px;
    }

    .user-dropdown-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary);
    }

    .user-dropdown-info h6 {
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--gray-800);
        text-transform: capitalize;
    }

    .user-dropdown-info p {
        font-size: 0.85rem;
        color: var(--gray-500);
        margin: 0;
    }

    .user-dropdown-divider {
        height: 1px;
        background-color: var(--gray-200);
        margin: 10px 0;
    }

    .user-dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border-radius: 5px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--gray-700);
    }

    .user-dropdown-item:hover {
        background-color: var(--gray-100);
        color: var(--primary);
    }

    .user-dropdown-item i {
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }

    .user-dropdown-item.logout {
        background-color: var(--danger);
        color: white;
        margin-top: 10px;
    }

    .user-dropdown-item.logout:hover {
        background-color: #dc2626;
    }

    /* Dashboard Content Styles */
    .dashboard-content {
        padding: 30px;
    }

    .page-title {
        margin-bottom: 10px;
        font-weight: 700;
        color: var(--gray-800);
    }

    .page-subtitle {
        color: var(--gray-500);
        margin-bottom: 30px;
        font-size: 1.1rem;
    }

    .welcome-alert {
        background: linear-gradient(135deg, var(--success) 0%, var(--success-dark) 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(34, 197, 94, 0.2);
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card.members {
        border-left-color: var(--info);
    }

    .stat-card.books {
        border-left-color: var(--success);
    }

    .stat-card.borrows {
        border-left-color: var(--warning);
    }

    .stat-card.returns {
        border-left-color: var(--secondary);
    }

    .stat-card.fines {
        border-left-color: var(--danger);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        font-size: 1.5rem;
        color: white;
    }

    .stat-icon.members {
        background-color: var(--info);
    }

    .stat-icon.books {
        background-color: var(--success);
    }

    .stat-icon.borrows {
        background-color: var(--warning);
    }

    .stat-icon.returns {
        background-color: var(--secondary);
    }

    .stat-icon.fines {
        background-color: var(--danger);
    }

    .stat-title {
        font-size: 0.9rem;
        color: var(--gray-500);
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0;
    }

    .quick-actions {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: var(--primary);
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }

    .action-card {
        background-color: var(--gray-100);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--gray-800);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        color: var(--primary);
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 10px;
    }

    .action-icon.members {
        background: linear-gradient(135deg, var(--info) 0%, #60a5fa 100%);
    }

    .action-icon.books {
        background: linear-gradient(135deg, var(--success) 0%, #86efac 100%);
    }

    .action-icon.borrows {
        background: linear-gradient(135deg, var(--warning) 0%, #fcd34d 100%);
    }

    .action-icon.returns {
        background: linear-gradient(135deg, var(--secondary) 0%, #818cf8 100%);
    }

    .action-icon.fines {
        background: linear-gradient(135deg, var(--danger) 0%, #fca5a5 100%);
    }

    .action-title {
        font-weight: 600;
        margin: 0;
    }

    /* Footer Styles */
    .footer {
        position: fixed;
        bottom: 0;
        left: var(--sidebar-width);
        right: 0;
        background-color: white;
        padding: 15px 30px;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
        z-index: 990;
    }

    .footer-text {
        color: var(--gray-600);
        font-size: 0.9rem;
    }

    .footer-text span {
        color: var(--primary);
        font-weight: 600;
    }

    .footer-version {
        color: var(--gray-500);
        font-size: 0.85rem;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main-content,
        .topbar,
        .footer {
            margin-left: 0;
            left: 0;
        }

        .toggle-sidebar {
            display: block;
        }

        .stats-row {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .dashboard-content {
            padding: 20px;
        }

        .user-name {
            display: none;
        }

        .stats-row {
            grid-template-columns: 1fr;
        }

        .actions-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease forwards;
    }

    .delay-1 {
        animation-delay: 0.1s;
    }

    .delay-2 {
        animation-delay: 0.2s;
    }

    .delay-3 {
        animation-delay: 0.3s;
    }

    .delay-4 {
        animation-delay: 0.4s;
    }

    .delay-5 {
        animation-delay: 0.5s;
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h1>BookHaven</h1>
        <button class="close-sidebar" id="closeSidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <p class="menu-header">Menu Utama</p>
            <a href="#" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span class="menu-text">Dashboard</span>
            </a>
            <a href="member/member.php" class="menu-item">
                <i class="fas fa-users"></i>
                <span class="menu-text">Member</span>
            </a>
            <a href="buku/daftarBuku.php" class="menu-item">
                <i class="fas fa-book"></i>
                <span class="menu-text">Buku</span>
            </a>
            <a href="peminjaman/peminjamanBuku.php" class="menu-item">
                <i class="fas fa-hand-holding"></i>
                <span class="menu-text">Peminjaman</span>
            </a>
            <a href="pengembalian/pengembalianBuku.php" class="menu-item">
                <i class="fas fa-undo"></i>
                <span class="menu-text">Pengembalian</span>
            </a>
            <a href="denda/daftarDenda.php" class="menu-item">
                <i class="fas fa-money-bill-wave"></i>
                <span class="menu-text">Denda</span>
            </a>

            <p class="menu-header">Menu Lainnya</p>
            <a href="bantuan/bantuan.html" class="menu-item">
                <i class="fas fa-question-circle"></i>
                <span class="menu-text">Bantuan</span>
            </a>
        </div>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <div class="d-flex align-items-center">
            <button class="toggle-sidebar me-3" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="topbar-title mb-0">Dashboard Admin</h5>
        </div>
        <div class="user-dropdown">
            <button class="user-dropdown-toggle" id="userDropdownToggle">
                <img src="../assets/adminLogo.png" alt="Admin" class="user-avatar">
                <span class="user-name"><?php echo $_SESSION['admin']['nama_admin']; ?></span>
                <i class="fas fa-chevron-down ms-2"></i>
            </button>
            <div class="user-dropdown-menu" id="userDropdownMenu">
                <div class="user-dropdown-header">
                    <img src="../assets/adminLogo.png" alt="Admin" class="user-dropdown-avatar">
                    <div class="user-dropdown-info">
                        <h6><?php echo $_SESSION['admin']['nama_admin']; ?></h6>
                        <p>Administrator</p>
                    </div>
                </div>
                <div class="user-dropdown-divider"></div>

                <a href="#" class="user-dropdown-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Akun Terverifikasi</span>
                </a>
                <a href="signOut.php" class="user-dropdown-item logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-content">
            <?php
            // Mendapatkan tanggal dan waktu saat ini
            $date = date('Y-m-d H:i:s'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
            // Mendapatkan hari dalam format teks (e.g., Senin, Selasa, ...)
            $day = date('l');
            // Mendapatkan tanggal dalam format 1 hingga 31
            $dayOfMonth = date('d');
            // Mendapatkan bulan dalam format teks (e.g., Januari, Februari, ...)
            $month = date('F');
            // Mendapatkan tahun dalam format 4 digit (e.g., 2023)
            $year = date('Y');
            ?>

            <h1 class="page-title animate-fade-in">Dashboard Admin</h1>
            <p class="page-subtitle animate-fade-in delay-1">
                <?php echo $day. ", ". $dayOfMonth." ". $month. " ". $year; ?></p>

            <div class="welcome-alert animate-fade-in delay-2">
                <h4><i class="fas fa-hand-wave me-2"></i> Selamat datang,
                    <?php echo $_SESSION['admin']['nama_admin']; ?>!</h4>
                <p class="mb-0">Selamat datang di Dashboard Admin BookHaven. Kelola perpustakaan dengan mudah dan
                    efisien.</p>
            </div>

            <div class="stats-row animate-fade-in delay-3">
                <div class="stat-card members">
                    <div class="stat-icon members">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="stat-title">Total Member</p>
                    <h3 class="stat-value"><?php echo number_format(getTotalMembers()); ?></h3>
                </div>
                <div class="stat-card books">
                    <div class="stat-icon books">
                        <i class="fas fa-book"></i>
                    </div>
                    <p class="stat-title">Total Buku</p>
                    <h3 class="stat-value"><?php echo number_format(getTotalBooks()); ?></h3>
                </div>
                <div class="stat-card borrows">
                    <div class="stat-icon borrows">
                        <i class="fas fa-hand-holding"></i>
                    </div>
                    <p class="stat-title">Peminjaman Aktif</p>
                    <h3 class="stat-value"><?php echo getActiveLoans(); ?></h3>
                </div>
                <div class="stat-card returns">
                    <div class="stat-icon returns">
                        <i class="fas fa-undo"></i>
                    </div>
                    <p class="stat-title">Pengembalian Hari Ini</p>
                    <h3 class="stat-value"><?php echo getReturnsToday(); ?></h3>
                </div>
                <div class="stat-card fines">
                    <div class="stat-icon fines">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <p class="stat-title">Total Denda</p>
                    <h3 class="stat-value"><?php echo (getTotalFines() > 0) ? formatRupiah(getTotalFines()) : 'Rp 0'; ?></h3>
                </div>
            </div>

            <div class="quick-actions animate-fade-in delay-4">
                <h5 class="section-title"><i class="fas fa-bolt"></i> Akses Cepat</h5>
                <div class="actions-grid">
                    <a href="member/member.php" class="action-card">
                        <div class="action-icon members">
                            <i class="fas fa-users"></i>
                        </div>
                        <h6 class="action-title">Kelola Member</h6>
                    </a>
                    <a href="buku/daftarBuku.php" class="action-card">
                        <div class="action-icon books">
                            <i class="fas fa-book"></i>
                        </div>
                        <h6 class="action-title">Kelola Buku</h6>
                    </a>
                    <a href="peminjaman/peminjamanBuku.php" class="action-card">
                        <div class="action-icon borrows">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                        <h6 class="action-title">Peminjaman</h6>
                    </a>
                    <a href="pengembalian/pengembalianBuku.php" class="action-card">
                        <div class="action-icon returns">
                            <i class="fas fa-undo"></i>
                        </div>
                        <h6 class="action-title">Pengembalian</h6>
                    </a>
                    <a href="denda/daftarDenda.php" class="action-card">
                        <div class="action-icon fines">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h6 class="action-title">Kelola Denda</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p class="footer-text">Created by <span>Alpian</span> © 2025</p>
        <p class="footer-version">versi 1.0</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
    // Toggle Sidebar
    const toggleSidebar = document.getElementById('toggleSidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const topbar = document.querySelector('.topbar');
    const footer = document.querySelector('.footer');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });

    // Close sidebar when X button is clicked
    closeSidebar.addEventListener('click', () => {
        sidebar.classList.remove('show');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 992) {
            if (!sidebar.contains(e.target) && !toggleSidebar.contains(e.target) && sidebar.classList.contains(
                    'show')) {
                sidebar.classList.remove('show');
            }
        }
    });

    // User Dropdown
    const userDropdownToggle = document.getElementById('userDropdownToggle');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    userDropdownToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdownMenu.classList.toggle('show');
    });

    document.addEventListener('click', (e) => {
        if (!userDropdownMenu.contains(e.target) && !userDropdownToggle.contains(e.target)) {
            userDropdownMenu.classList.remove('show');
        }
    });

    // Active Menu Item
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            menuItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
    </script>
</body>

</html>