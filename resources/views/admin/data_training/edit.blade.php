<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Training - Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background-color: #198754; min-height: 100vh; color: white; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.8); margin-bottom: 10px; border-radius: 5px; }
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
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-chart-pie me-2"></i> Dashboard Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.data_training.index') }}">
                            <i class="fa-solid fa-database me-2"></i> Data Training
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-history me-2"></i> Riwayat Global
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
            <div class="border-bottom pb-3 mb-4">
                <h2 class="text-green-theme fw-bold m-0">Ubah Data Latih</h2>
                <p class="text-muted m-0">Perbarui nilai parameter kriteria bibit pisang raja (ID Data: {{ $data->id }}).</p>
            </div>
            <div class="card border-0 shadow-sm col-lg-8">
                <div class="card-body p-4">
                    <form action="{{ route('admin.data_training.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">V1 (Tinggi Batang)</label>
                                <input type="number" step="any" name="v1" class="form-control @error('v1') is-invalid @enderror" value="{{ old('v1', $data->v1) }}" required>
                                @error('v1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">V2 (Jumlah Daun)</label>
                                <input type="number" step="any" name="v2" class="form-control @error('v2') is-invalid @enderror" value="{{ old('v2', $data->v2) }}" required>
                                @error('v2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">V3 (Kondisi Akar)</label>
                                <input type="number" step="any" name="v3" class="form-control @error('v3') is-invalid @enderror" value="{{ old('v3', $data->v3) }}" required>
                                @error('v3') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">V4 (Diameter Batang)</label>
                                <input type="number" step="any" name="v4" class="form-control @error('v4') is-invalid @enderror" value="{{ old('v4', $data->v4) }}" required>
                                @error('v4') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Kelas Kualitas</label>
                            <select name="kelas" class="form-select @error('kelas') is-invalid @enderror" required>
                                <option value="Baik" {{ old('kelas', $data->kelas) == 'Baik' ? 'selected' : '' }}>BAIK</option>
                                <option value="Sedang" {{ old('kelas', $data->kelas) == 'Sedang' ? 'selected' : '' }}>SEDANG</option>
                                <option value="Tidak Baik" {{ old('kelas', $data->kelas) == 'Tidak Baik' ? 'selected' : '' }}>TIDAK BAIK</option>
                            </select>
                            @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning fw-bold px-4 text-dark"><i class="fa-solid fa-floppy-disk me-2"></i> Perbarui Data</button>
                            <a href="{{ route('admin.data_training.index') }}" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>