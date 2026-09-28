<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Training - Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background-color: #198754; min-height: 100vh; color: white; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.8); margin-bottom: 10px; border-radius: 5px; text-decoration: none; display: block; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background-color: #146c43; font-weight: bold; }
        .text-green-theme { color: #198754; }
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
                <h2 class="text-green-theme fw-bold m-0">Manajemen Data Latih</h2>
                <a href="{{ route('admin.data_training.create') }}" class="btn btn-success fw-bold px-3">
                    <i class="fa-solid fa-plus me-2"></i> Tambah Data Latih
                </a>
            </div>
            <p class="text-muted m-0">Berikut adalah daftar dataset kriteria bibit pisang raja.</p>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show fw-bold mt-3" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show fw-bold mt-3" role="alert">
                    <i class="fa-solid fa-circle-xmark me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-success border-success text-dark">
                        <tr>
                            <th style="width: 7%">No</th>
                            <th>V1 (Tinggi)</th>
                            <th>V2 (Daun)</th>
                            <th>V3 (Akar)</th>
                            <th>V4 (Batang)</th>
                            <th>Kelas Kualitas</th>
                            <th style="width: 18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataLatih as $key => $row)
                        <tr>
                            <td>{{ $dataLatih->firstItem() + $key }}</td>
                            <td><span class="badge bg-secondary px-3 py-2 fs-6">{{ $row->v1 }}</span></td>
                            <td><span class="badge bg-secondary px-3 py-2 fs-6">{{ $row->v2 }}</span></td>
                            <td><span class="badge bg-secondary px-3 py-2 fs-6">{{ $row->v3 }}</span></td>
                            <td><span class="badge bg-secondary px-3 py-2 fs-6">{{ $row->v4 }}</span></td>
                            <td>
                                @if($row->kelas == 'Baik')
                                    <span class="badge bg-success px-3 py-2 text-uppercase">{{ $row->kelas }}</span>
                                @elseif($row->kelas == 'Sedang')
                                    <span class="badge bg-warning text-dark px-3 py-2 text-uppercase">{{ $row->kelas }}</span>
                                @else
                                    <span class="badge bg-danger px-3 py-2 text-uppercase">{{ $row->kelas }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.data_training.edit', $row->id) }}" class="btn btn-sm btn-warning fw-bold text-dark me-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Ubah
                                </a>
                                
                                <form action="{{ route('admin.data_training.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data latih ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger fw-bold">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Data Latih Belum Tersedia.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $dataLatih->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>