<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - SPK Pisang Raja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background-color: #198754; min-height: 100vh; color: white; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.8); margin-bottom: 10px; border-radius: 5px; text-decoration: none; display: block; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background-color: #146c43; font-weight: bold; }
        .text-green-theme { color: #198754; }
        .card-custom { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: transform 0.2s; }
        .card-custom:hover { transform: translateY(-5px); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar p-3 d-flex flex-column justify-content-between">
            <div>
                <div class="text-center my-3">
                    <h5 class="fw-bold m-0">Panel Admin</h5>
                    <small class="text-white-50">Sistem Kendali Penuh</small>
                </div>
                <hr>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-chart-pie me-2"></i> Dashboard Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.data_training.*') ? 'active' : '' }}" href="{{ route('admin.data_training.index') }}">
                            <i class="fa-solid fa-database me-2"></i> Data Training
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.riwayat') ? 'active' : '' }}" href="{{ route('admin.riwayat') }}">
                            <i class="fa-solid fa-history me-2"></i> Riwayat Inputan User
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-9 col-lg-10 p-4 shadow-sm bg-white" style="min-height: 100vh;">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h2 class="text-green-theme fw-bold m-0">Dashboard Admin</h2>
                <span class="badge bg-success px-3 py-2 fs-6">Status: Administrator</span>
            </div>
            <p class="text-muted">Selamat Datang Admin! Berikut adalah rangkuman metrik data latih Naïve Bayes dan aktivitas pengujian user saat ini.</p>
            
            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="card card-custom bg-light border-start border-success border-4 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase small fw-bold">Total Data Latih</h6>
                                <h2 class="fw-bold m-0 text-green-theme">{{ $totalDataLatih }}</h2>
                            </div>
                            <div class="fs-1 text-success opacity-50"><i class="fa-solid fa-folder-open"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom bg-light border-start border-primary border-4 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase small fw-bold">Total Riwayat Uji</h6>
                                <h2 class="fw-bold m-0 text-primary">{{ $totalRiwayatUser }}</h2>
                            </div>
                            <div class="fs-1 text-primary opacity-50"><i class="fa-solid fa-calculator"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom bg-light border-start border-info border-4 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase small fw-bold">Total User Penguji</h6>
                                <h2 class="fw-bold m-0 text-info">{{ $totalUser }}</h2>
                            </div>
                            <div class="fs-1 text-info opacity-50"><i class="fa-solid fa-users"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="text-green-theme fw-bold mt-5 mb-3">Distribusi Kelas Kualitas Data Latih</h4>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-custom text-white bg-success p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase small fw-bold opacity-75">Kualitas: Baik</h6>
                                <h2 class="fw-bold m-0">{{ $totalBaik }} <span class="fs-6 fw-normal">Baris</span></h2>
                            </div>
                            <div class="fs-1 opacity-25"><i class="fa-solid fa-circle-check"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom text-white bg-warning p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase small fw-bold opacity-75">Kualitas: Sedang</h6>
                                <h2 class="fw-bold m-0">{{ $totalSedang }} <span class="fs-6 fw-normal">Baris</span></h2>
                            </div>
                            <div class="fs-1 opacity-25"><i class="fa-solid fa-circle-minus"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom text-white bg-danger p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase small fw-bold opacity-75">Kualitas: Tidak Baik</h6>
                                <h2 class="fw-bold m-0">{{ $totalTidakBaik }} <span class="fs-6 fw-normal">Baris</span></h2>
                            </div>
                            <div class="fs-1 opacity-25"><i class="fa-solid fa-circle-xmark"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>