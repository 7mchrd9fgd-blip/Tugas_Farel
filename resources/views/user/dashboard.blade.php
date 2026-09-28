@extends('user.layout')

@section('content')
<div class="d-flex align-items-center gap-3 mb-2">
    <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success">
        <i class="fa-solid fa-circle-info fs-4"></i>
    </div>
    <h4 class="fw-bold text-dark m-0">Langkah Panduan Penggunaan Sistem</h4>
</div>
<p class="text-muted small mb-4">Selamat datang di Panel Sistem Pendukung Keputusan Kualitas Bibit Tanaman Pisang Raja Daerah Istimewa Yogyakarta. Silakan ikuti panduan berikut dengan seksama:</p>

<hr class="text-muted opacity-25 mb-4">

<div class="row">
    <div class="col-md-12">
        <div class="d-flex flex-column gap-3">
            
            <div class="card border border-light-subtle shadow-sm rounded-4 p-3 d-flex flex-row align-items-start gap-4">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; min-width: 38px;">
                    1
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-bold text-success mb-1" style="font-size: 1.05rem;">Pilih Menu Input Kriteria</h6>
                    <p class="text-secondary small m-0">Akses menu <strong>Input Kriteria</strong> yang berada pada panel menu navigasi di sebelah kiri dashboard Anda.</p>
                </div>
            </div>

            <div class="card border border-light-subtle shadow-sm rounded-4 p-3 d-flex flex-row align-items-start gap-4">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; min-width: 38px;">
                    2
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-bold text-success mb-1" style="font-size: 1.05rem;">Isi Nilai Karakteristik Fisik Bibit (Skala Matriks 1-5)</h6>
                    <p class="text-secondary small mb-2">Masukkan kondisi fisik riil dari bibit pisang raja yang sedang diuji berdasarkan indikator kriteria baku:</p>
                    <div class="p-2.5 bg-light rounded-3 px-3 d-inline-block border border-light-subtle">
                        <span class="small text-muted fw-medium">Keterangan Skala Angka Penilaian:</span>
                        <div class="d-flex flex-wrap gap-2 mt-1 small">
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 py-1.5 px-2.5 rounded-pill fw-semibold">1 = Tidak Baik</span>
                            <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning border-opacity-20 py-1.5 px-2.5 rounded-pill fw-semibold">2 = Kurang Baik</span>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10 py-1.5 px-2.5 rounded-pill fw-semibold">3 = Sedang</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 py-1.5 px-2.5 rounded-pill fw-semibold">4 = Baik</span>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-10 py-1.5 px-2.5 rounded-pill fw-semibold">5 = Sangat Baik</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border border-light-subtle shadow-sm rounded-4 p-3 d-flex flex-row align-items-start gap-4">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; min-width: 38px;">
                    3
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-bold text-success mb-1" style="font-size: 1.05rem;">Submit & Lihat Hasil Analisis Persentase</h6>
                    <p class="text-secondary small m-0">Klik tombol <strong>Hitung Kualitas Bibit</strong>. Sistem secara cerdas akan langsung mengeksekusi komputasi menggunakan rumus matematika <em>Naïve Bayes Laplace Smoothing</em> dan langsung menampilkan visualisasi hitungan transparannya di tabel riwayat.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection