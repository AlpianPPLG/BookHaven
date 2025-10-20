<?php
require "../../config/config.php";
$buku = queryReadData("SELECT * FROM buku");

// mengaktifkan tombol search engine
if(isset($_POST["search"]) ) {
  //buat variabel dan ambil apa saja yg diketikkan user di dalam input dan kirimkan ke function search.
  $buku = search($_POST["keyword"]);
}

// Hitung total buku
$totalBuku = count($buku);
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
    <title>Kelola Buku || Admin</title>
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
        --danger-dark: #dc2626;
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

    .navbar-nav .nav-link {
        font-weight: 500;
        padding: 10px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin: 0 5px;
    }

    .navbar-nav .nav-link:hover {
        background-color: var(--gray-100);
        color: var(--primary);
    }

    .navbar-nav .nav-link.active {
        background-color: var(--primary);
        color: white;
    }

    .navbar-nav .nav-link.text-success {
        color: var(--success-dark) !important;
    }

    .navbar-nav .nav-link.text-success:hover {
        background-color: rgba(34, 197, 94, 0.1);
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
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

    /* Stats Cards */
    .stats-container {
        margin-bottom: 30px;
    }

    .stats-card {
        background-color: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        border-left: 5px solid var(--primary);
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    .stats-title {
        font-size: 1rem;
        color: var(--gray-600);
        margin-bottom: 10px;
    }

    .stats-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0;
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

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .action-btn.primary {
        background-color: var(--primary);
        color: white;
    }

    .action-btn.primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(67, 97, 238, 0.2);
    }

    .action-btn.success {
        background-color: var(--success);
        color: white;
    }

    .action-btn.success:hover {
        background-color: var(--success-dark);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(34, 197, 94, 0.2);
    }

    /* Books Container */
    .books-container {
        background-color: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .books-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .books-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0;
    }

    .books-title i {
        color: var(--primary);
    }

    .books-count {
        background-color: var(--primary);
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
    }

    /* Book Card */
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
        height: 250px;
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
        margin-bottom: 15px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-details {
        margin-bottom: 15px;
    }

    .book-detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid var(--gray-200);
    }

    .book-detail-item:last-child {
        border-bottom: none;
    }

    .book-detail-label {
        font-size: 0.85rem;
        color: var(--gray-500);
        min-width: 80px;
    }

    .book-detail-value {
        font-size: 0.9rem;
        color: var(--gray-800);
        font-weight: 500;
    }

    .book-actions {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }

    .book-btn {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .book-btn.edit {
        background-color: var(--primary);
        color: white;
    }

    .book-btn.edit:hover {
        background-color: var(--primary-dark);
    }

    .book-btn.delete {
        background-color: var(--danger);
        color: white;
    }

    .book-btn.delete:hover {
        background-color: var(--danger-dark);
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
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
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

        .books-container {
            padding: 20px;
        }

        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
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

        .book-detail-item {
            padding: 6px 0;
        }

        .book-detail-label {
            font-size: 0.8rem;
            min-width: 70px;
        }

        .book-detail-value {
            font-size: 0.85rem;
        }

        .book-btn {
            padding: 8px;
            font-size: 0.8rem;
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
    <nav class="navbar fixed-top navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h1>BookHaven</h1>
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../dashboardAdmin.php">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="tambahBuku.php">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Buku
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header text-center animate-fade-in">
        <div class="container">
            <h1>Kelola Buku Perpustakaan</h1>
            <p>Tambah, edit, dan hapus buku dalam koleksi perpustakaan</p>
        </div>
    </header>

    <div class="container">
        <!-- Stats Section -->
        <div class="row stats-container animate-fade-in delay-1">
            <div class="col-md-4 mb-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <p class="stats-title">Total Buku</p>
                    <h3 class="stats-value"><?= $totalBuku ?></h3>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <p class="stats-title">Kategori</p>
                    <h3 class="stats-value">5</h3>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="stats-title">Peminjam Aktif</p>
                    <h3 class="stats-value">24</h3>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons animate-fade-in delay-2">
            <a href="tambahBuku.php" class="action-btn success">
                <i class="fas fa-plus-circle"></i>
                Tambah Buku Baru
            </a>
            <a href="../dashboardAdmin.php" class="action-btn primary">
                <i class="fas fa-tachometer-alt"></i>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Search Section -->
        <div class="search-container animate-fade-in delay-2">
            <h5 class="search-title"><i class="fas fa-search"></i> Cari Buku</h5>
            <form action="" method="post" class="search-form">
                <input class="search-input" type="text" name="keyword" id="keyword"
                    placeholder="Cari judul, kategori, atau ID buku..."
                    value="<?= isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>">
                <button class="search-btn" type="submit" name="search">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Books Section -->
        <div class="books-container animate-fade-in delay-3">
            <div class="books-header">
                <h5 class="books-title"><i class="fas fa-book"></i> Daftar Buku</h5>
                <span class="books-count"><?= $totalBuku ?> Buku</span>
            </div>

            <?php if(empty($buku)): ?>
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <h3>Buku Tidak Ditemukan</h3>
                <p>Maaf, kami tidak dapat menemukan buku yang Anda cari. Silakan coba dengan kata kunci lain atau
                    tambahkan buku baru.</p>
                <a href="tambahBuku.php" class="action-btn success">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Buku Baru
                </a>
            </div>
            <?php else: ?>
            <div class="books-grid">
                <?php foreach ($buku as $item) : ?>
                <div class="book-card animate-fade-in delay-4">
                    <img src="../../imgDB/<?= $item["cover"]; ?>" class="book-cover" alt="<?= $item["judul"]; ?>">
                    <div class="book-info">
                        <h5 class="book-title"><?= $item["judul"]; ?></h5>
                        <div class="book-details">
                            <div class="book-detail-item">
                                <span class="book-detail-label">Kategori</span>
                                <span class="book-detail-value"><?= $item["kategori"]; ?></span>
                            </div>
                            <div class="book-detail-item">
                                <span class="book-detail-label">ID Buku</span>
                                <span class="book-detail-value"><?= $item["id_buku"]; ?></span>
                            </div>
                        </div>
                        <div class="book-actions">
                            <a class="book-btn edit" href="updateBuku.php?idReview=<?= $item["id_buku"]; ?>"
                                id="review">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a class="book-btn delete" href="deleteBuku.php?id=<?= $item["id_buku"]; ?>"
                                onclick="return confirm('Yakin ingin menghapus data buku?');">
                                <i class="fas fa-trash-alt"></i> Hapus
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