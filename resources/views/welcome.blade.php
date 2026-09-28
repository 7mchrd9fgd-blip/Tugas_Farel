<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pisang Raja - Beranda Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
        }
        /* Navbar Styling */
        .navbar-theme {
            background-color: #198754 !important;
        }
        .navbar-theme .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .navbar-theme .nav-link:hover, .navbar-theme .nav-link.active {
            color: #ffffff !important;
            font-weight: 600;
        }
        /* Hero Section Styling dengan Gambar Lokal */
        .hero-section {
            background: linear-gradient(rgba(25, 135, 84, 0.9), rgba(25, 135, 84, 0.9)), 
                        url("{{ asset('images/hero-beranda.jpg') }}");
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.3;
        }
        .hero-subtitle {
            font-size: 1.15rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 20px auto 0 auto;
        }
        /* Feature Icon Styling */
        .feature-icon {
            font-size: 2.5rem;
            color: #198754;
            margin-bottom: 15px;
            display: inline-block;
            transition: transform 0.3s ease;
        }
        .feature-box:hover .feature-icon {
            transform: scale(1.1);
        }
        .text-justify {
            text-align: justify;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark navbar-theme shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-pisang.jpg') }}" alt="Logo Pisang" width="32" height="32" class="me-2 style-object-contain">
            Pisang Raja
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}"><i class="fa-solid fa-circle-info me-1"></i> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('pengembang') ? 'active' : '' }}" href="{{ route('pengembang') }}"><i class="fa-solid fa-code me-1"></i> Pengembang</a>
                </li>
                @auth
                    <!-- JIKA USER SUDAH LOGIN -->
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-warning btn-sm px-3 text-dark fw-bold">
                            <i class="fa-solid fa-gauge me-1"></i> Dashboard
                        </a>
                    </li>
                @else
                    <!-- JIKA USER BELUM LOGIN -->
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3"><i class="fa-solid fa-right-to-bracket me-1"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-warning btn-sm px-3 text-dark fw-bold">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<header class="hero-section shadow-sm">
    <div class="container">
        <h1 class="hero-title mx-auto" style="max-width: 900px;">Sistem Klasifikasi Kualitas <br> Bibit Pisang Raja</h1>
        <p class="hero-subtitle">Penerapan Metode Naïve Bayes Classification untuk Menentukan Bibit Pisang Unggul di Daerah Istimewa Yogyakarta</p>
        <div class="mt-4 d-flex justify-content-center gap-3">
            @auth
                <!-- TAMPILAN JIKA SUDAH LOGIN -->
                <a href="{{ route('user.dashboard') }}" class="btn btn-warning btn-lg fw-bold text-dark px-4 py-2 shadow-sm">
                    <i class="fa-solid fa-gauge me-2"></i> Kembali ke Dashboard
                </a>
                <a href="{{ route('user.input_matriks') }}" class="btn btn-outline-light btn-lg px-4 py-2">
                    <i class="fa-solid fa-calculator me-2"></i> Mulai Klasifikasi
                </a>
            @else
                <!-- TAMPILAN DEFAULT JIKA BELUM LOGIN -->
                <a href="{{ route('register') }}" class="btn btn-warning btn-lg fw-bold text-dark px-4 py-2 shadow-sm">
                    <i class="fa-solid fa-user-plus me-2"></i> Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-2">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Login Akses
                </a>
            @endauth
        </div>
    </div>
</header>

<main class="flex-grow-1">
    <section class="container my-5 py-4">
        <div class="row align-items-center g-5">
            <div class="col-md-7 col-lg-7">
                <h3 class="fw-bold mb-3" style="color: #198754;">Tentang Sistem Keputusan</h3>
                <p class="text-muted text-justify lh-lg mb-3">
                    Sistem ini dirancang khusus untuk mengklasifikasikan kualitas bibit tanaman Pisang Raja di wilayah Daerah Istimewa Yogyakarta. Melalui pendekatan algoritma <strong>Naïve Bayes Classification</strong> yang diperkuat dengan penanganan <strong>Laplace Smoothing</strong>, sistem mampu memberikan analisis prediksi yang objektif, cepat, dan akurat.
                </p>
                <p class="text-muted text-justify lh-lg">
                    With mengevaluasi 4 parameter utama tanaman, yaitu tinggi bibit, warna daun, kondisi morfologi akar, serta ketebalan batang utama, sistem ini diharapkan dapat membantu para petani lokal maupun dinas terkait dalam menyaring bibit unggul demi memaksimalkan hasil panen dan meminimalkan kegagalan budidaya.
                </p>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="position-relative shadow rounded overflow-hidden">
                    <img src="{{ asset('images/foto-utama.jpg') }}" class="img-fluid" alt="Kualitas Pisang Raja" style="object-fit: cover; width: 100%; height: 320px; display: block;">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5 border-top border-bottom">
        <div class="container text-center">
            <h3 class="mb-5 fw-bold" style="color: #198754;">4 Parameter Utama Klasifikasi</h3>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-3 feature-box">
                    <div class="p-3 bg-white h-100 rounded shadow-sm">
                        <div class="feature-icon"><i class="fa-solid fa-arrows-up-down"></i></div>
                        <h5 class="fw-bold text-dark fs-6">Tinggi Bibit</h5>
                        <p class="text-muted small mt-2 mb-0">Mengukur pertumbuhan vertikal batang bibit pisang raja.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 feature-box">
                    <div class="p-3 bg-white h-100 rounded shadow-sm">
                        <div class="feature-icon"><i class="fa-solid fa-leaf"></i></div>
                        <h5 class="fw-bold text-dark fs-6">Warna Daun</h5>
                        <p class="text-muted small mt-2 mb-0">Mendeteksi tingkat klorofil dan kesehatan daun bibit.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 feature-box">
                    <div class="p-3 bg-white h-100 rounded shadow-sm">
                        <div class="feature-icon"><i class="fa-solid fa-diagram-project"></i></div>
                        <h5 class="fw-bold text-dark fs-6">Kondisi Akar</h5>
                        <p class="text-muted small mt-2 mb-0">Menilai kekuatan serta serapan hara organ bawah tanaman.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 feature-box">
                    <div class="p-3 bg-white h-100 rounded shadow-sm">
                        <div class="feature-icon"><i class="fa-solid fa-ruler-horizontal"></i></div>
                        <h5 class="fw-bold text-dark fs-6">Ketebalan Batang</h5>
                        <p class="text-muted small mt-2 mb-0">Menilai kekokohan batang utama dari risiko patah berventilasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="text-center py-4 text-muted bg-white small mt-auto border-top">
    <div class="container">
        &copy; 2026 Pisang Raja — Hak Cipta Dilindungi Sistem Kendali Penuh.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>