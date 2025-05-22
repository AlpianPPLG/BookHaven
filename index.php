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
    <title>CuyPerpus.com</title>
    <link rel="icon" href="assets/logoUrl.png" type="image/png">
    <style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --accent: #4cc9f0;
        --success: #4ade80;
        --warning: #f59e0b;
        --danger: #ef4444;
        --text-dark: #1e293b;
        --text-light: #f8fafc;
        --bg-light: #f8f9fa;
        --bg-dark: #0f172a;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: var(--text-dark);
        background-color: var(--bg-light);
        overflow-x: hidden;
    }

    /* Navbar Styling */
    .navbar {
        padding: 15px 0;
        transition: all 0.3s ease;
        background-color: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
    }

    .navbar-brand {
        display: flex;
        align-items: center;
    }

    .navbar-nav {
        margin-left: auto;
    }

    .nav-link {
        font-weight: 500;
        margin: 0 10px;
        position: relative;
        color: var(--text-dark) !important;
        transition: all 0.3s ease;
    }

    .nav-link:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background-color: var(--primary);
        bottom: -3px;
        left: 0;
        transition: width 0.3s ease;
    }

    .nav-link:hover:after,
    .nav-link.active:after {
        width: 100%;
    }

    .nav-link.active {
        color: var(--primary) !important;
        font-weight: 600;
    }

    /* Hero Section */
    #homeSection {
        padding-top: 120px !important;
        padding-bottom: 80px !important;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .hero-content {
        padding: 2rem;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        background: linear-gradient(90deg, var(--primary), var(--success));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        line-height: 1.8;
        margin-bottom: 2rem;
        color: #6c757d;
    }

    .hero-image {
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        max-width: 100%;
        height: auto;
    }

    .hero-image:hover {
        transform: translateY(-10px);
    }

    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: var(--secondary);
        border-color: var(--secondary);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
    }

    /* About Section */
    #aboutSection {
        padding: 100px 0;
        background-color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    #aboutSection::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(76, 201, 240, 0.05) 0%, rgba(67, 97, 238, 0.05) 100%);
        z-index: 0;
    }

    .section-title {
        position: relative;
        display: inline-block;
        font-weight: 700;
        margin-bottom: 2rem;
        color: var(--primary);
        z-index: 1;
    }

    .section-title::after {
        content: '';
        position: absolute;
        width: 50px;
        height: 3px;
        background-color: var(--primary);
        bottom: -10px;
        left: 0;
    }

    .about-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #6c757d;
        margin-bottom: 3rem;
        position: relative;
        z-index: 1;
    }

    .developer-title {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 2rem;
        text-align: center;
    }

    .team-card {
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: none;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: var(--primary);
        color: white;
        font-weight: 600;
        padding: 15px 20px;
        border: none;
    }

    .card-body {
        padding: 25px;
    }

    /* Features Section */
    #featuresSection {
        padding: 100px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
    }

    #featuresSection::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5z' fill='%234361ee' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        z-index: 0;
    }

    .section-title-center {
        position: relative;
        font-weight: 700;
        margin-bottom: 3rem;
        color: var(--primary);
        text-align: center;
        z-index: 1;
    }

    .section-title-center::after {
        content: '';
        position: absolute;
        width: 80px;
        height: 3px;
        background-color: var(--primary);
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
    }

    .feature-card {
        background-color: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        z-index: 1;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: white;
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
    }

    .feature-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--text-dark);
    }

    .feature-description {
        color: #6c757d;
        line-height: 1.7;
    }

    /* Testimonials Section */
    #testimonialsSection {
        padding: 100px 0;
        background-color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    #testimonialsSection::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(76, 201, 240, 0.05) 0%, rgba(67, 97, 238, 0.05) 100%);
        z-index: 0;
    }

    .testimonial-card {
        background-color: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        z-index: 1;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .testimonial-quote {
        font-size: 3rem;
        color: var(--primary);
        opacity: 0.2;
        position: absolute;
        top: 20px;
        right: 30px;
    }

    .testimonial-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #6c757d;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 3px solid var(--primary);
    }

    .testimonial-info h5 {
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--text-dark);
    }

    .testimonial-info p {
        color: #6c757d;
        margin: 0;
    }

    .testimonial-rating {
        color: var(--warning);
        margin-top: 5px;
    }

    /* FAQ Section */
    #faqSection {
        padding: 100px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
    }

    #faqSection::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5z' fill='%234361ee' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        z-index: 0;
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .accordion-item {
        margin-bottom: 15px;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .accordion-header {
        background-color: white;
    }

    .accordion-button {
        padding: 20px 25px;
        font-weight: 600;
        color: var(--text-dark);
        background-color: white;
        box-shadow: none !important;
    }

    .accordion-button:not(.collapsed) {
        color: var(--primary);
        background-color: white;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, 0.05);
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%234361ee' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
    }

    .accordion-body {
        padding: 20px 25px;
        color: #6c757d;
        background-color: white;
    }

    /* Footer */
    #footer {
        background-color: var(--bg-dark);
        color: var(--text-light);
        padding: 60px 0 30px;
    }

    .footer-logo {
        margin-bottom: 20px;
    }

    .footer-heading {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: white;
    }

    .footer-text {
        color: #a1a1aa;
        line-height: 1.6;
    }

    .social-links {
        margin-top: 30px;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        margin-right: 10px;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background-color: var(--primary);
        transform: translateY(-3px);
        color: white;
    }

    .footer-divider {
        margin: 30px 0;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .copyright {
        color: #a1a1aa;
        text-align: center;
    }

    .copyright a {
        color: var(--accent);
        transition: color 0.3s ease;
    }

    .copyright a:hover {
        color: white;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-content {
            text-align: center;
            padding: 1rem;
        }

        .hero-image-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .navbar-nav {
            margin-left: 0;
            margin-top: 1rem;
        }

        .section-title-center {
            font-size: 1.8rem;
        }

        .feature-card,
        .testimonial-card {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        #homeSection {
            padding-top: 100px !important;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .section-title-center {
            font-size: 1.6rem;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .feature-title {
            font-size: 1.2rem;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
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
        animation: fadeIn 1s ease forwards;
    }

    .delay-1 {
        animation-delay: 0.2s;
    }

    .delay-2 {
        animation-delay: 0.4s;
    }

    .delay-3 {
        animation-delay: 0.6s;
    }

    .delay-4 {
        animation-delay: 0.8s;
    }

    .delay-5 {
        animation-delay: 1s;
    }
    </style>
</head>

<body>
    <!--Navbar-->
    <nav class="navbar fixed-top navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/logoNav.png" alt="CuyPerpus Logo" width="120px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#homeSection">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutSection">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#featuresSection">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonialsSection">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faqSection">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contactSection">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-lg-3" href="sign/link_login.html">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="homeSection">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content animate-fade-in">
                    <h1 class="hero-title">
                        <span>Cuy</span>Perpus
                    </h1>
                    <p class="hero-subtitle animate-fade-in delay-1">
                        "Temukan Dunia Pengetahuan di Ujung Jari Anda: Perpustakaan Online <span
                            class="fw-bold">CuyPerpus</span> Membawa Anda ke Dunia Buku Digital."
                    </p>
                    <a class="btn btn-primary animate-fade-in delay-2" href="sign/link_login.html">
                        Get Started <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-6 hero-image-container animate-fade-in delay-3">
                    <img src="assets/logoDashboard-transformed.jpeg" class="hero-image" alt="CuyPerpus Dashboard">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="aboutSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title">About CuyPerpus</h2>
                    <p class="about-text">
                        Kami percaya bahwa pengetahuan adalah kekuatan, dan setiap individu berhak mendapatkan akses ke
                        sumber
                        daya pendidikan yang berkualitas. Inilah sebabnya kami menciptakan aplikasi perpustakaan online
                        kami, yang dirancang untuk menjadi pintu
                        gerbang ke ribuan buku, artikel, dan sumber daya belajar lainnya, semuanya hanya dalam genggaman
                        Anda.
                    </p>
                    <p class="about-text">
                        Kami berdedikasi untuk memajukan literasi dan pembelajaran seumur hidup,
                        dan kami ingin menjadi mitra Anda dalam perjalanan pembelajaran Anda. Aplikasi perpustakaan kami
                        telah
                        dirancang dengan antarmuka yang ramah pengguna, fitur pencarian canggih, dan koleksi konten yang
                        terus berkembang untuk menginspirasi dan
                        memberdayakan semua anggota komunitas kami.
                    </p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="developer-title">Dikembangkan Oleh</h3>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="card-header">Alpian</div>
                        <div class="card-body">
                            <h5 class="card-title">Student At SMKN 7 Samarinda</h5>
                            <p class="card-text mt-3">
                                <i class="fa-solid fa-code me-2"></i> Web Developer
                            </p>
                            <p class="card-text">
                                <i class="fa-solid fa-graduation-cap me-2"></i> Jurusan Rekayasa Perangkat Lunak
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="featuresSection">
        <div class="container">
            <h2 class="section-title-center animate-fade-in">Fitur Unggulan CuyPerpus</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-fade-in delay-1">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="feature-title">Pencarian Cepat</h3>
                        <p class="feature-description">
                            Temukan buku yang Anda cari dengan cepat menggunakan fitur pencarian canggih berdasarkan
                            judul, penulis, atau kategori.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-fade-in delay-2">
                        <div class="feature-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h3 class="feature-title">Peminjaman Digital</h3>
                        <p class="feature-description">
                            Pinjam buku dengan mudah melalui sistem digital yang efisien dan lacak semua peminjaman Anda
                            dalam satu dashboard.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-fade-in delay-3">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="feature-title">Notifikasi Otomatis</h3>
                        <p class="feature-description">
                            Dapatkan pengingat otomatis tentang tanggal jatuh tempo pengembalian buku dan informasi
                            penting lainnya.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-fade-in delay-2">
                        <div class="feature-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <h3 class="feature-title">Riwayat Peminjaman</h3>
                        <p class="feature-description">
                            Akses riwayat lengkap peminjaman Anda untuk melacak buku apa saja yang pernah Anda baca.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-fade-in delay-3">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">Responsif di Semua Perangkat</h3>
                        <p class="feature-description">
                            Akses perpustakaan dari perangkat apa pun - desktop, tablet, atau smartphone dengan tampilan
                            yang optimal.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-fade-in delay-4">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">Keamanan Data</h3>
                        <p class="feature-description">
                            Data Anda selalu aman dengan sistem keamanan terkini yang melindungi informasi pribadi dan
                            riwayat peminjaman.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonialsSection">
        <div class="container">
            <h2 class="section-title-center animate-fade-in">Apa Kata Mereka?</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card animate-fade-in delay-1">
                        <i class="fas fa-quote-right testimonial-quote"></i>
                        <p class="testimonial-text">
                            "CuyPerpus sangat membantu saya dalam mencari referensi untuk tugas sekolah. Sistem
                            pencarian bukunya cepat dan mudah digunakan!"
                        </p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Testimonial Author"
                                class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h5>Dina Putri</h5>
                                <p>Siswa SMA</p>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card animate-fade-in delay-2">
                        <i class="fas fa-quote-right testimonial-quote"></i>
                        <p class="testimonial-text">
                            "Sebagai guru, saya sangat terbantu dengan adanya CuyPerpus. Saya bisa dengan mudah
                            merekomendasikan buku-buku berkualitas kepada siswa saya."
                        </p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/men/46.jpg" alt="Testimonial Author"
                                class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h5>Budi Santoso</h5>
                                <p>Guru Bahasa Indonesia</p>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card animate-fade-in delay-3">
                        <i class="fas fa-quote-right testimonial-quote"></i>
                        <p class="testimonial-text">
                            "Fitur notifikasi pengembalian buku sangat membantu saya untuk tidak terlambat mengembalikan
                            buku. Interface-nya juga sangat user-friendly!"
                        </p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Testimonial Author"
                                class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h5>Ratna Dewi</h5>
                                <p>Mahasiswa</p>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faqSection">
        <div class="container">
            <h2 class="section-title-center animate-fade-in">Pertanyaan yang Sering Diajukan</h2>
            <div class="faq-container">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item animate-fade-in delay-1">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Bagaimana cara mendaftar di CuyPerpus?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Untuk mendaftar di CuyPerpus, klik tombol "Login" di menu navigasi, lalu pilih opsi
                                "Sign Up" pada halaman login. Isi formulir pendaftaran dengan data diri Anda yang valid,
                                lalu klik tombol "Daftar". Setelah berhasil mendaftar, Anda dapat langsung login
                                menggunakan username dan password yang telah dibuat.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item animate-fade-in delay-2">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Berapa lama batas waktu peminjaman buku?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Batas waktu peminjaman buku di CuyPerpus adalah 7 hari kalender terhitung sejak tanggal
                                peminjaman. Anda dapat memperpanjang masa peminjaman sebanyak 1 kali dengan durasi
                                tambahan 7 hari, dengan syarat buku yang dipinjam tidak sedang dipesan oleh member lain
                                dan Anda tidak memiliki denda yang belum dibayar.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item animate-fade-in delay-3">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Bagaimana cara meminjam buku di CuyPerpus?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Untuk meminjam buku, login ke akun member Anda, cari buku yang ingin dipinjam melalui
                                menu "Daftar Buku", klik tombol "Detail" pada buku yang ingin dipinjam, lalu klik tombol
                                "Pinjam Buku" pada halaman detail buku. Konfirmasi peminjaman dan buku akan tercatat
                                sebagai dipinjam oleh Anda.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item animate-fade-in delay-4">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Bagaimana jika saya terlambat mengembalikan buku?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Jika Anda terlambat mengembalikan buku, akan dikenakan denda sebesar Rp 1.000 per hari
                                untuk setiap buku. Denda akan otomatis dihitung oleh sistem dan harus dibayarkan sebelum
                                Anda dapat meminjam buku lagi. Anda dapat melihat dan membayar denda melalui menu
                                "Denda" di dashboard member.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item animate-fade-in delay-5">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Apakah CuyPerpus dapat diakses melalui perangkat mobile?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, CuyPerpus dirancang dengan tampilan responsif sehingga dapat diakses dengan nyaman
                                melalui berbagai perangkat, termasuk smartphone dan tablet. Anda dapat mengakses semua
                                fitur CuyPerpus melalui browser di perangkat mobile Anda tanpa perlu menginstal aplikasi
                                tambahan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contactSection">
        <div class="container contact-container">
            <h2 class="section-title-center animate-fade-in">Hubungi Kami</h2>
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <div class="contact-info-card animate-fade-in delay-1">
                        <h3 class="mb-4">Informasi Kontak</h3>

                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Alamat</h5>
                                <p>Jl Pelta 2 Sulstan Sulaiman Samarinda, Kalimantan Timur, Indonesia</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Email</h5>
                                <p><a href="mailto:info@cuyperpus.com">info@cuyperpus.com</a></p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Telepon</h5>
                                <p><a href="tel:+6282354877197">+62 823 5487 7197</a></p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Jam Operasional</h5>
                                <p>Senin - Jumat: 08:00 - 17:00<br>Sabtu: 09:00 - 15:00</p>
                            </div>
                        </div>

                        <div class="social-links-contact">
                            <a href="#" class="social-link-contact"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link-contact"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link-contact"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link-contact"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link-contact"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form-card animate-fade-in delay-2">
                        <h3 class="mb-4">Kirim Pesan</h3>
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Masukkan nama lengkap Anda" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="Masukkan alamat email Anda" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subjek</label>
                                <input type="text" class="form-control" id="subject" placeholder="Masukkan subjek pesan"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea class="form-control" id="message" rows="5"
                                    placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>

                    <div class="mt-4 animate-fade-in delay-3" style="width: 100%; max-width: 500px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127672.75772082225!2d117.07942449999999!3d-0.4997420999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df5d57d33074935%3A0xef63a044f7874b73!2sSamarinda%2C%20Kota%20Samarinda%2C%20Kalimantan%20Timur!5e0!3m2!1sid!2sid!4v1653037241218!5m2!1sid!2sid"
                            class="contact-map" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" style="width: 100%; height: 300px;"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <img src="assets/logoFooter.png" class="footer-logo" width="200px" alt="CuyPerpus Logo">
                    <p class="footer-text">
                        Perpustakaan digital untuk semua. Akses ribuan buku dari mana saja dan kapan saja.
                    </p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-heading">Alamat</h3>
                    <p class="footer-text">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        Jl Pelta 2 Sulstan Sulaiman Samarinda
                    </p>
                    <p class="footer-text">
                        <i class="fa-solid fa-envelope me-2"></i>
                        info@cuyperpus.com
                    </p>
                    <p class="footer-text">
                        <i class="fa-solid fa-phone me-2"></i>
                        +62 823 5487 7197
                    </p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-heading">Tautan Cepat</h3>
                    <ul class="list-unstyled footer-text">
                        <li class="mb-2"><a href="#homeSection" class="text-decoration-none footer-text">Home</a></li>
                        <li class="mb-2"><a href="#aboutSection" class="text-decoration-none footer-text">About</a></li>
                        <li class="mb-2"><a href="#featuresSection"
                                class="text-decoration-none footer-text">Features</a></li>
                        <li class="mb-2"><a href="#testimonialsSection"
                                class="text-decoration-none footer-text">Testimonials</a></li>
                        <li class="mb-2"><a href="#faqSection" class="text-decoration-none footer-text">FAQ</a></li>
                        <li class="mb-2"><a href="sign/link_login.html"
                                class="text-decoration-none footer-text">Login</a></li>
                    </ul>
                </div>
            </div>

            <hr class="footer-divider">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fa-brands fa-github"></i></a>
                        <a href="#" class="social-link"><i class="fa-brands fa-telegram"></i></a>
                        <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="copyright">
                        Made with <i class="fa-solid fa-heart text-danger"></i> by <a href="#"
                            class="text-decoration-none">Alpian</a> &copy; 2025
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
    // Active link handler
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('section, footer');

        function setActiveLink() {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (pageYOffset >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');

                if (href === `#${current}`) {
                    link.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', setActiveLink);
        setActiveLink();
    });

    // Contact form submission
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Simple form validation
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            if (name && email && subject && message) {
                // In a real application, you would send this data to a server
                alert('Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
                contactForm.reset();
            } else {
                alert('Mohon lengkapi semua field yang diperlukan.');
            }
        });
    }
    </script>
</body>

</html>