<?php
// =========================
// Halaman daftar buku member
// Menampilkan seluruh data buku dan fitur filter kategori
// =========================
session_start();

// Cek apakah member sudah login
if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}

require "../../config/config.php";

// Ambil seluruh data buku dari database
$buku = queryReadData("SELECT * FROM buku");

// Jika tombol search ditekan, lakukan pencarian buku berdasarkan keyword
if(isset($_POST["search"]) ) {
  $buku = search($_POST["keyword"]);
}

// Filter buku berdasarkan kategori
if(isset($_POST["informatika"]) ) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'informatika'");
}
if(isset($_POST["bisnis"]) ) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'bisnis'");
}
if(isset($_POST["filsafat"]) ) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'filsafat'");
}
if(isset($_POST["novel"]) ) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'novel'");
}
if(isset($_POST["sains"]) ) {
  $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'sains'");
}

// Menentukan kategori aktif untuk highlight UI
$activeCategory = "all";
if(isset($_POST["informatika"])) $activeCategory = "informatika";
if(isset($_POST["bisnis"])) $activeCategory = "bisnis";
if(isset($_POST["filsafat"])) $activeCategory = "filsafat";
if(isset($_POST["novel"])) $activeCategory = "novel";
if(isset($_POST["sains"])) $activeCategory = "sains";
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
    <title>Daftar Buku || Member</title>
    <style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --secondary: #3f37c9;
        --success: #4ade80;
        --success-dark: #22c55e;
        --info: #3b82f6;
        --warning: #f59e0b;
        --danger: #ef4444;
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
        padding-top: 80px;
    }

    /* Navbar Styles */
    .navbar {
        background: white !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .navbar-brand img {
        max-height: 40px;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
        transform: scale(1.05);
    }

    .dashboard-btn {
        background-color: var(--primary);
        color: white;
        border-radius: 8px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dashboard-btn:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #4cc9f0 0%, var(--primary) 100%);
        color: white;
        padding: 40px 0;
        border-radius: 0 0 20px 20px;
        margin-bottom: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .page-header h1 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Filter Buttons */
    .filter-container {
        background-color: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .filter-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-title i {
        color: var(--primary);
    }

    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .filter-btn {
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid var(--gray-200);
        background-color: white;
        color: var(--gray-700);
    }

    .filter-btn:hover {
        background-color: var(--gray-100);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .filter-btn.active {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Search Bar */
    .search-container {
        background-color: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .search-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-title i {
        color: var(--primary);
    }

    .search-form {
        display: flex;
        max-width: 600px;
        margin: 0 auto;
    }

    .search-input {
        flex: 1;
        padding: 12px 20px;
        border: 1px solid var(--gray-200);
        border-right: none;
        border-radius: 50px 0 0 50px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: var(--gray-100);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .search-btn {
        padding: 12px 25px;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 0 50px 50px 0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background-color: var(--primary-dark);
    }

    /* Book Cards */
    .books-container {
        background-color: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .books-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .books-title i {
        color: var(--primary);
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 25px;
    }

    .book-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--gray-200);
    }

    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .book-cover {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-bottom: 1px solid var(--gray-200);
    }

    .book-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 10px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-category {
        display: inline-block;
        padding: 5px 12px;
        background-color: var(--gray-100);
        color: var(--gray-700);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .book-category.informatika {
        background-color: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    .book-category.bisnis {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .book-category.filsafat {
        background-color: rgba(139, 92, 246, 0.1);
        color: #8b5cf6;
    }

    .book-category.novel {
        background-color: rgba(236, 72, 153, 0.1);
        color: #ec4899;
    }

    .book-category.sains {
        background-color: rgba(34, 197, 94, 0.1);
        color: var(--success-dark);
    }

    .book-actions {
        margin-top: auto;
    }

    .detail-btn {
        display: inline-block;
        width: 100%;
        padding: 10px;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .detail-btn:hover {
        background-color: var(--primary-dark);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--gray-300);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        color: var(--gray-700);
        margin-bottom: 10px;
    }

    .empty-state p {
        color: var(--gray-500);
        max-width: 500px;
        margin: 0 auto 20px;
    }

    /* Footer */
    .footer {
        background-color: white;
        padding: 20px 0;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        margin-top: 50px;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
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
        .page-header {
            padding: 30px 0;
        }

        .page-header h1 {
            font-size: 2rem;
        }

        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 25px 0;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 1.8rem;
        }

        .filter-buttons {
            gap: 8px;
        }

        .filter-btn {
            padding: 6px 15px;
            font-size: 0.85rem;
        }

        .books-container {
            padding: 20px;
        }

        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 15px;
        }

        .book-cover {
            height: 220px;
        }

        .book-info {
            padding: 15px;
        }

        .book-title {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .page-header p {
            font-size: 0.9rem;
        }

        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 12px;
        }

        .book-cover {
            height: 180px;
        }

        .book-info {
            padding: 12px;
        }

        .book-title {
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .book-category {
            padding: 4px 10px;
            font-size: 0.75rem;
            margin-bottom: 12px;
        }

        .detail-btn {
            padding: 8px;
            font-size: 0.85rem;
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
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
            <h1>BookHaven</h1>
        </a>
            <a class="dashboard-btn" href="../dashboardMember.php">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header text-center animate-fade-in">
        <div class="container">
            <h1>Katalog Buku Perpustakaan</h1>
            <p>Jelajahi koleksi buku kami yang lengkap dan temukan buku yang Anda cari</p>
        </div>
    </header>

    <div class="container">
        <!-- Filter Section -->
        <div class="filter-container animate-fade-in delay-1">
            <h5 class="filter-title"><i class="fas fa-filter"></i> Filter Kategori</h5>
            <form action="" method="post">
                <div class="filter-buttons">
                    <button class="filter-btn <?= $activeCategory == 'all' ? 'active' : '' ?>" type="submit">Semua
                        Buku</button>
                    <button type="submit" name="informatika"
                        class="filter-btn <?= $activeCategory == 'informatika' ? 'active' : '' ?>">Informatika</button>
                    <button type="submit" name="bisnis"
                        class="filter-btn <?= $activeCategory == 'bisnis' ? 'active' : '' ?>">Bisnis</button>
                    <button type="submit" name="filsafat"
                        class="filter-btn <?= $activeCategory == 'filsafat' ? 'active' : '' ?>">Filsafat</button>
                    <button type="submit" name="novel"
                        class="filter-btn <?= $activeCategory == 'novel' ? 'active' : '' ?>">Novel</button>
                    <button type="submit" name="sains"
                        class="filter-btn <?= $activeCategory == 'sains' ? 'active' : '' ?>">Sains</button>
                </div>
            </form>
        </div>

        <!-- Search Section -->
        <div class="search-container animate-fade-in delay-2">
            <h5 class="search-title"><i class="fas fa-search"></i> Cari Buku</h5>
            <form action="" method="post" class="search-form">
                <input class="search-input" type="text" name="keyword" id="keyword"
                    placeholder="Cari judul atau kategori buku..."
                    value="<?= isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>">
                <button class="search-btn" type="submit" name="search">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Books Section -->
        <div class="books-container animate-fade-in delay-3">
            <h5 class="books-title"><i class="fas fa-book"></i> Daftar Buku</h5>

            <?php if(empty($buku)): ?>
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <h3>Buku Tidak Ditemukan</h3>
                <p>Maaf, kami tidak dapat menemukan buku yang Anda cari. Silakan coba dengan kata kunci lain atau filter
                    yang berbeda.</p>
            </div>
            <?php else: ?>
            <div class="books-grid">
                <?php foreach ($buku as $item) : ?>
                <div class="book-card animate-fade-in delay-4">
                    <img src="../../imgDB/<?= $item["cover"]; ?>" class="book-cover" alt="<?= $item["judul"]; ?>">
                    <div class="book-info">
                        <h5 class="book-title"><?= $item["judul"]; ?></h5>
                        <span
                            class="book-category <?= strtolower($item["kategori"]); ?>"><?= $item["kategori"]; ?></span>
                        <div class="book-actions">
                            <a class="detail-btn" href="detailBuku.php?id=<?= $item["id_buku"]; ?>">
                                <i class="fas fa-info-circle"></i> Detail Buku
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p class="footer-text">Created by <span>Alpian</span> © 2025</p>
                <p class="footer-version">versi 1.0</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>