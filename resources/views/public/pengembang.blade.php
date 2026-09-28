<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pisang Raja - Tim Peneliti & Pengembang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
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
        
        /* --- BEAUTIFIED HEADER STYLING --- */
        .header-section {
            position: relative;
            padding: 2.5rem 0 1.5rem 0;
        }
        .header-icon-badge {
            background-color: #e8f5e9;
            color: #198754;
            font-size: 1.25rem;
            width: 50px;
            height: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.1);
            margin-bottom: 1rem;
        }
        .gradient-title {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #116639 0%, #198754 50%, #60b644 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.75rem;
        }
        .header-divider {
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #198754, #a3e635);
            margin: 0 auto 1.2rem auto;
            border-radius: 10px;
        }
        .subtitle-custom {
            font-size: 1.05rem;
            color: #5c636a;
            max-width: 650px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        /* Team Card Premium Styling */
        .team-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(25, 135, 84, 0.12);
        }
        
        /* Profile Image Ring */
        .profile-img-wrapper {
            width: 130px;
            height: 130px;
            margin: 0 auto;
            border-radius: 50%;
            padding: 5px;
            background: linear-gradient(135deg, #198754, #a3e635);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
        .profile-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            background-color: #fff;
        }

        /* Role Badges */
        .role-badge {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            display: inline-block;
        }
        .badge-dosen { background-color: #e8f5e9; color: #198754; }
        .badge-mhs1 { background-color: #fff9db; color: #f59f00; }
        .badge-mhs2 { background-color: #e3f2fd; color: #1e88e5; }

        /* Institution Card Premium Styling (Lebar Penuh) */
        .institution-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }
        .card-accent-top {
            height: 6px;
            background: linear-gradient(90deg, #198754, #a3e635);
        }
        .info-table th {
            color: #495057;
            font-weight: 600;
            width: 20%;
        }
        .info-table td {
            color: #5c636a;
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
            <img src="{{ asset('images/logo-pisang.jpg') }}" alt="Logo Pisang" width="32" height="32" class="me-2 rounded-circle" style="object-fit: cover;">
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

<!-- KONTEN UTAMA -->
<main class="container my-4 flex-grow-1">
    
    <!-- HEADER SECTION YANG SUDAH DIPERCANTIK -->
    <div class="header-section text-center mb-5">
        <div class="header-icon-badge">
            <i class="fa-solid fa-people-group"></i>
        </div>
        <h2 class="gradient-title"> Profil Tim Peneliti & Pengembang</h2>
        <div class="header-divider"></div>
        <p class="subtitle-custom">
            Kolaborasi akademisi dibalik riset mendalam, perancangan algoritma, dan implementasi sistem komputasi klasifikasi kualitas bibit Pisang Raja.
        </p>
    </div>

    <!-- GRID BARIS PROFIL TIM -->
    <div class="row g-4 justify-content-center mb-5">

        <div class="col-md-6 col-lg-4">
            <div class="card team-card h-100 p-4 text-center">
                <div class="mb-3">
                    <span class="role-badge badge-mhs1">Peneliti 1</span>
                </div>
                <div class="profile-img-wrapper mb-3">
                    <img src="{{ asset('images/rel.jpeg') }}" alt="Farel Juliani Syahdi">
                </div>
                <h5 class="fw-bold text-dark mb-1">Farel Juliani Syahdi</h5>
                <p class="text-warning small fw-semibold mb-2">Software Engineer / Web Developer</p>
                <p class="text-muted small border-top pt-2 mt-2"><i class="fa-solid fa-university me-1"></i> Universitas Janabadra</p>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card team-card h-100 p-4 text-center">
                <div class="mb-3">
                    <span class="role-badge badge-mhs2">Peneliti 2</span>
                </div>
                <div class="profile-img-wrapper mb-3">
                    <img src="{{ asset('images/set.jpeg') }}" alt="Setyo">
                </div>
                <h5 class="fw-bold text-dark mb-1">Setyo</h5>
                <p class="text-primary small fw-semibold mb-2">Analist Data</p>
                <p class="text-muted small border-top pt-2 mt-2"><i class="fa-solid fa-university me-1"></i> Universitas Janabadra</p>
            </div>
        </div>
    </div>

    <!-- CARD INFORMASI INSTITUSI PENDIDIKAN (LEBAR SEJAJAR DENGAN ATAS) -->
    <div class="row">
        <div class="col-12">
            <div class="card institution-card">
                <div class="card-accent-top"></div>
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-success text-white rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-building-columns fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Institusi Pendidikan</h5>
                            <p class="text-muted small mb-0">Naungan akademis resmi pelaksanaan riset sistem</p>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table info-table table-borderless mb-0">
                            <tbody>
                                <tr class="border-bottom">
                                    <th class="py-3"><i class="fa-solid fa-graduation-cap me-2 text-success"></i> Nama Kampus</th>
                                    <td class="py-3 fw-semibold text-dark">Universitas Janabadra</td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="py-3"><i class="fa-solid fa-book-open me-2 text-success"></i> Program Studi</th>
                                    <td class="py-3">Informatika</td>
                                </tr>
                                <tr>
                                    <th class="py-3"><i class="fa-solid fa-map-location-dot me-2 text-success"></i> Lokasi / Alamat</th>
                                    <td class="py-3 text-justify lh-lg">Jl. Tentara Rakyat Mataram No.55-57, Bumijo, Kec. Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55231, Indonesia</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="text-center py-4 text-muted bg-white small border-top mt-auto">
    <div class="container">
        &copy; 2026 Pisang Raja — Hak Cipta Dilindungi Sistem Kendali Penuh.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>