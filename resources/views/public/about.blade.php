<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pisang Raja - Tentang Objek Penelitian</title>
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
        
        /* About Card Premium */
        .about-card {
            background: #ffffff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }
        /* Garis aksen premium di atas kartu */
        .card-accent-top {
            height: 6px;
            background: linear-gradient(90deg, #198754, #a3e635);
        }
        .text-justify {
            text-align: justify;
        }
        
        /* Custom Badge Objek Penelitian dengan Foto Pisang */
        .object-badge {
            background-color: #e8f5e9;
            color: #198754;
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 10px rgba(25, 135, 84, 0.08);
            border: 1px solid rgba(25, 135, 84, 0.15);
        }
        .object-badge img {
            width: 22px;
            height: 22px;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Highlight Box untuk Tantangan */
        .challenge-box {
            background-color: #fff9db;
            border-left: 5px solid #f59f00;
            border-radius: 12px;
            padding: 1.5rem;
        }

        /* --- STYLING KRITERIA: PERBAIKAN AGAR GAMBAR TIDAK TERPOTONG --- */
        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #212529;
            position: relative;
            padding-bottom: 0.5rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3.5px;
            background-color: #198754;
            border-radius: 2px;
        }
        .kriteria-card {
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            transition: all 0.3s ease;
        }
        .kriteria-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.06);
            border-color: rgba(25, 135, 84, 0.2);
        }
        .kriteria-img-wrapper {
            position: relative;
            height: 260px; /* Tinggi disesuaikan untuk tampilan mobile */
            background-color: #f8f9fa; /* Latar belakang abu-abu terang yang lembut */
            overflow: hidden;
        }
        @media (min-width: 768px) {
            .kriteria-card {
                height: 240px; /* Dinaikkan ke 240px agar foto portrait vertikal memiliki ruang lebih tinggi & terlihat besar */
            }
            .kriteria-img-wrapper {
                height: 100%;
            }
        }
        .kriteria-img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* SOLUSI UTAMA: Mengubah ke 'contain' agar gambar utuh 100% dari atas sampai bawah (tidak terpotong) */
            background-color: #f8f9fa; /* Menyelaraskan background gambar */
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 6px; /* Memberikan sedikit ruang/napas di dalam kotak agar terlihat rapi */
        }
        .kriteria-img:hover {
            filter: brightness(93%);
            transform: scale(1.02);
        }
        
        .modal-backdrop.show {
            opacity: 0.8;
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
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-warning btn-sm px-3 text-dark fw-bold">
                            <i class="fa-solid fa-gauge me-1"></i> Dashboard
                        </a>
                    </li>
                @else
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

<div class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card about-card">
                <div class="card-accent-top"></div>
                
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-5">
                        <span class="object-badge mb-3 gap-2">
                            <img src="{{ asset('images/logo-pisang.jpg') }}" alt="Mini Logo Pisang">
                            Objek Penelitian
                        </span>
                        <h2 class="fw-bold text-dark mt-2 display-6">Tanaman Pisang Raja (DIY)</h2>
                        <p class="text-muted">Komoditas Hortikultura Unggulan Daerah Istimewa Yogyakarta</p>
                    </div>
                    
                    <hr class="mb-5 text-muted opacity-25">
                    
                    <div class="row g-4 align-items-center mb-4">
                        <div class="col-12">
                            <p class="text-muted text-justify lh-lg mb-0" style="font-size: 1.05rem;">
                                <span class="fw-bold text-success">Tanaman Pisang Raja</span> merupakan salah satu komoditas hortikultura unggulan di Daerah Istimewa Yogyakarta (DIY) yang bernilai ekonomi tinggi. Keberadaannya menjadi pilar penting bagi pendapatan petani lokal serta pemenuhan kebutuhan pasar buah daerah maupun nasional.
                            </p>
                        </div>
                    </div>
                    
                    <div class="challenge-box mb-4 shadow-sm">
                        <div class="d-flex gap-3 align-items-start">
                            <div class="text-warning fs-4 pt-1 px-2">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">Tantangan Utama Petani</h6>
                                <p class="text-muted small text-justify mb-0 lh-lg" style="font-size: 0.95rem;">
                                    Proses pemilihan bibit yang dilakukan secara manual di lapangan sering kali bersifat subjektif, rentan terhadap kesalahan manusia (<em>human error</em>), dan tidak konsisten.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-4 align-items-center mb-5">
                        <div class="col-12">
                            <p class="text-muted text-justify lh-lg mb-0" style="font-size: 1.05rem;">
                                Oleh karena itu, menentukan bibit berkualitas unggul menjadi kunci utama demi menjamin produktivitas hasil panen yang optimal. Karakteristik fisik bibit memerlukan standardisasi penilaian yang objektif, yang kini diintegrasikan ke dalam sistem cerdas berbasis komputasi untuk mempermudah pengambilan keputusan secara akurat.
                            </p>
                        </div>
                    </div>

                    <hr class="my-5 text-muted opacity-25">
                    
                    <div class="mb-4">
                        <h4 class="section-title">Kriteria Kualitas Bibit Pisang Raja</h4>
                        <p class="text-muted small mt-2">Standardisasi parameter fisik dalam pengelompokan tingkat kelayakan bibit tanaman sebelum dibudidayakan (Klik pada gambar untuk memperbesar):</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-12">
                            <div class="kriteria-card">
                                <div class="row g-0 h-100">
                                    <div class="col-md-4 kriteria-img-wrapper">
                                        <img src="{{ asset('images/bibit-baik.jpg') }}" alt="Bibit Kategori Baik" class="kriteria-img" onerror="this.src='https://images.unsplash.com/photo-1528825871115-3581a5387919?q=80&w=400&auto=format&fit=crop'">
                                    </div>
                                    <div class="col-md-8 d-flex align-items-center">
                                        <div class="p-4">
                                            <h5 class="fw-bold text-success mb-2"><i class="fa-solid fa-circle-check me-2"></i>Kategori Baik</h5>
                                            <p class="text-muted text-justify mb-0 lh-lg" style="font-size: 0.93rem;">
                                                Bibit pisang raja yang baik biasanya memiliki batang semu yang tegak, berwarna hijau segar, dan tidak terdapat bercak atau kerusakan. Daunnya tampak sehat, tidak layu, serta akar terlihat kuat dan bersih. Bibit seperti ini sangat layak ditanam karena berpotensi menghasilkan tanaman yang produktif.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="kriteria-card">
                                <div class="row g-0 h-100">
                                    <div class="col-md-4 kriteria-img-wrapper">
                                        <img src="{{ asset('images/bibit-sedang.jpg') }}" alt="Bibit Kategori Sedang" class="kriteria-img" onerror="this.src='https://images.unsplash.com/photo-1594911774802-8822a707c935?q=80&w=400&auto=format&fit=crop'">
                                    </div>
                                    <div class="col-md-8 d-flex align-items-center">
                                        <div class="p-4">
                                            <h5 class="fw-bold text-warning mb-2"><i class="fa-solid fa-circle-minus me-2"></i>Kategori Sedang</h5>
                                            <p class="text-muted text-justify mb-0 lh-lg" style="font-size: 0.93rem;">
                                                Bibit kategori sedang menunjukkan kondisi yang masih bisa diperbaiki. Batang semu mungkin sedikit kusam atau terdapat bekas luka kecil, daunnya ada yang menguning, dan akar tidak terlalu banyak. Dengan perawatan intensif seperti pemupukan dan pengendalian hama, bibit ini masih bisa tumbuh baik, meski hasilnya tidak seoptimal bibit berkualitas tinggi.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="kriteria-card">
                                <div class="row g-0 h-100">
                                    <div class="col-md-4 kriteria-img-wrapper">
                                        <img src="{{ asset('images/bibit-tidakbaik.jpg') }}" alt="Bibit Kategori Tidak Baik" class="kriteria-img" onerror="this.src='https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=400&auto=format&fit=crop'">
                                    </div>
                                    <div class="col-md-8 d-flex align-items-center">
                                        <div class="p-4">
                                            <h5 class="fw-bold text-danger mb-2"><i class="fa-solid fa-circle-xmark me-2"></i>Tidak Baik</h5>
                                            <p class="text-muted text-justify mb-0 lh-lg" style="font-size: 0.93rem;">
                                                Sementara itu, bibit yang tidak baik biasanya terlihat lemah dengan batang semu yang bengkok atau berwarna cokelat kehitaman, daun layu atau rusak, serta akar yang sedikit atau busuk. Bibit seperti ini sebaiknya dihindari karena berisiko gagal tumbuh dan hanya akan membuang waktu serta biaya.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageLightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 p-0 justify-content-end">
                <button type="button" class="btn-close btn-close-white fs-4 p-3 shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <img src="" id="lightboxTargetImage" class="img-fluid rounded shadow-lg" style="max-height: 80vh; object-fit: contain; background-color: rgba(0,0,0,0.4);">
                <p id="lightboxCaption" class="text-white mt-3 fw-semibold bg-dark d-inline-block px-3 py-1 rounded-pill bg-opacity-70"></p>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-4 text-muted bg-white small border-top mt-auto">
    <div class="container">
        &copy; 2026 SPK Pisang Raja — Hak Cipta Dilindungi Sistem Kendali Penuh.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const kriteriaImages = document.querySelectorAll('.kriteria-img');
        const lightboxModalEl = document.getElementById('imageLightboxModal');
        const lightboxModal = new bootstrap.Modal(lightboxModalEl);
        const targetImg = document.getElementById('lightboxTargetImage');
        const targetCaption = document.getElementById('lightboxCaption');

        kriteriaImages.forEach(img => {
            img.addEventListener('click', function() {
                const imgSrc = this.getAttribute('src');
                const imgAlt = this.getAttribute('alt');

                targetImg.setAttribute('src', imgSrc);
                targetCaption.textContent = imgAlt;

                lightboxModal.show();
            });
        });
    });
</script>
</body>
</html>