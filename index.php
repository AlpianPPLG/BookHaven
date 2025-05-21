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
                        <a class="nav-link" href="#footer">Contact</a>
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
    </script>
</body>

</html>