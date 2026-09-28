<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - SPK Pisang Raja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #198754;
            padding-top: 20px;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 12px 20px;
            margin: 4px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
        }
        .sidebar .nav-link.active {
            background-color: #ffffff !important;
            color: #198754 !important;
            font-weight: bold;
        }
        .main-content {
            margin-left: 260px;
            padding: 30px;
        }
        .hr-custom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin: 15px 0;
        }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="px-4 mb-2">
            <h4 class="fw-bold text-white mb-0">Panel Admin</h4>
            <small class="text-white-50">Sistem Kendali Penuh</small>
        </div>
        <div class="hr-custom"></div>
        
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                    <i class="fa-solid fa-chart-pie me-2"></i> Dashboard Admin
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.data_training.index') }}" class="nav-link text-white">
                    <i class="fa-solid fa-database me-2"></i> Data Training
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.riwayat') }}" class="nav-link text-white active">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i> Riwayat Inputan User
                </a>
            </li>
        </ul>
    </div>
    
    <div class="p-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 py-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-right-from-bracket me-2"></i> Sign Out
            </button>
        </form>
    </div>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-success" style="color: #198754 !important;">Riwayat Inputan User </h2>
            <p class="text-muted mb-0">Daftar seluruh hasil pengujian kualitas bibit oleh user</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-success text-success">
                        <tr>
                            <th width="60" class="fw-bold">No</th>
                            <th class="fw-bold">Nama Penguji</th>
                            <th class="fw-bold">V1 (Tinggi)</th>
                            <th class="fw-bold">V2 (Daun)</th>
                            <th class="fw-bold">V3 (Akar)</th>
                            <th class="fw-bold">V4 (Batang)</th>
                            <th class="fw-bold">Hasil Kelas</th>
                            <th class="fw-bold">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $labelNilai = [
                                1 => 'Sangat Tidak Baik',
                                2 => 'Tidak Baik',
                                3 => 'Cukup',
                                4 => 'Baik',
                                5 => 'Sangat Baik'
                            ];
                        @endphp

                        @forelse($riwayatGlobal as $index => $item)
                            <tr>
                                <td>{{ $riwayatGlobal->firstItem() + $index }}</td>
                                <td><span class="fw-semibold">{{ $item->nama_user ?? 'Umum/Guest' }}</span></td>
                                <td><span class="badge bg-secondary px-2 py-1 fs-6">{{ $labelNilai[$item->v1] ?? $item->v1 }}</span></td>
                                <td><span class="badge bg-secondary px-2 py-1 fs-6">{{ $labelNilai[$item->v2] ?? $item->v2 }}</span></td>
                                <td><span class="badge bg-secondary px-2 py-1 fs-6">{{ $labelNilai[$item->v3] ?? $item->v3 }}</span></td>
                                <td><span class="badge bg-secondary px-2 py-1 fs-6">{{ $labelNilai[$item->v4] ?? $item->v4 }}</span></td>
                                <td>
                                    {{-- ✅ PERBAIKAN: Membaca kolom 'hasil_keputusan' yang sesuai dengan yang disimpan di UserController --}}
                                    @php
                                        $kelasHasil = $item->hasil_keputusan ?? 'Tidak Diketahui';
                                    @endphp
                                    
                                    @if($kelasHasil == 'Baik')
                                        <span class="badge bg-success px-3 py-2 fs-6">BAIK</span>
                                    @elseif($kelasHasil == 'Sedang')
                                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">SEDANG</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 fs-6">TIDAK BAIK</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ date('d M Y, H:i', strtotime($item->created_at)) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5 fs-5">
                                    <i class="fa-solid fa-folder-open d-block mb-3 text-secondary" style="font-size: 3rem;"></i>
                                    Belum ada riwayat pengujian dari user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-end">
                {{ $riwayatGlobal->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>