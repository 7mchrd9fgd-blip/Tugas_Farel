@extends('user.layout')

@section('content')
@php
    // Definisikan mapping angka ke keterangan teks
    $keterangan = [
        1 => 'Tidak Baik',
        2 => 'Kurang Baik',
        3 => 'Sedang',
        4 => 'Baik',
        5 => 'Sangat Baik'
    ];
@endphp

<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-3">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-success bg-opacity-10 p-3 rounded-3 text-success">
            <i class="fa-solid fa-chart-pie fs-4"></i>
        </div>
        <h4 class="fw-bold text-dark m-0">Hasil Identifikasi Kualitas Bibit Pisang Raja</h4>
    </div>
    <a href="{{ route('user.history') }}" class="btn btn-light border border-light-subtle px-3 py-2 fw-bold text-secondary shadow-sm d-inline-flex align-items-center gap-2" style="border-radius: 10px; font-size: 0.9rem;">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Tabel
    </a>
</div>

<hr class="text-muted opacity-25 my-4">

<div class="card border border-light-subtle shadow-sm rounded-4 mb-4 bg-light bg-opacity-40">
    <div class="card-body p-4">
        <h6 class="fw-bold text-secondary text-uppercase mb-3" style="font-size: 0.8rem; letter-spacing: 0.05em;">Kriteria Bibit Pisang Raja Yang Diuji</h6>
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="bg-white p-3 rounded-3 border border-light-subtle shadow-sm">
                    <small class="text-muted d-block mb-1">Tinggi (V1)</small>
                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $keterangan[$history->v1] ?? $history->v1 }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-3 rounded-3 border border-light-subtle shadow-sm">
                    <small class="text-muted d-block mb-1">Warna Daun (V2)</small>
                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $keterangan[$history->v2] ?? $history->v2 }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-3 rounded-3 border border-light-subtle shadow-sm">
                    <small class="text-muted d-block mb-1">Kondisi Akar (V3)</small>
                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $keterangan[$history->v3] ?? $history->v3 }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="bg-white p-3 rounded-3 border border-light-subtle shadow-sm">
                    <small class="text-muted d-block mb-1">Batang (V4)</small>
                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $keterangan[$history->v4] ?? $history->v4 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border border-light-subtle shadow-sm rounded-4 mb-4 overflow-hidden">
    <div class="card-header bg-light border-bottom border-light-subtle py-3 px-4">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-calculator text-success"></i>
            <h6 class="m-0 fw-bold text-dark">Nilai Akhir Probabilitas & Normalisasi Persentase</h6>
        </div>
    </div>
    <div class="card-body p-4 bg-white">
        <div class="d-flex flex-column gap-4">
            @foreach(['Baik', 'Sedang', 'Tidak Baik'] as $c)
                <div class="p-3 border border-light-subtle rounded-4 bg-light bg-opacity-20 shadow-sm">
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 1.05rem;">
                            <i class="fa-solid fa-chart-simple small opacity-50"></i> Score Kategori {{ $c }}
                        </span>
                        
                        @if($c === 'Baik')
                            <span class="badge bg-success px-3 py-2 rounded-pill fw-bold" style="font-size: 0.9rem;">{{ number_format($detail['percentage'][$c], 2) }}%</span>
                        @elseif($c === 'Sedang')
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold" style="font-size: 0.9rem;">{{ number_format($detail['percentage'][$c], 2) }}%</span>
                        @else
                            <span class="badge bg-danger px-3 py-2 rounded-pill fw-bold" style="font-size: 0.9rem;">{{ number_format($detail['percentage'][$c], 2) }}%</span>
                        @endif
                    </div>
                    
                    <div class="p-3 bg-dark text-warning rounded-3 font-monospace mb-0" style="font-size: 0.88rem; line-height: 1.6;">
                        <div class="text-white opacity-50 mb-1" style="font-size: 0.78rem;">[ FORMULA KALKULASI ]</div>
                        <div class="text-truncate opacity-75">= P({{ $c }}) × P(V1|{{ $c }}) × P(V2|{{ $c }}) × P(V3|{{ $c }}) × P(V4|{{ $c }})</div>
                        <div class="text-truncate opacity-75">= {{ number_format($detail['prior'][$c], 4) }} × {{ number_format($detail['conditional'][$c]['v1']['prob'], 4) }} × {{ number_format($detail['conditional'][$c]['v2']['prob'], 4) }} × {{ number_format($detail['conditional'][$c]['v3']['prob'], 4) }} × {{ number_format($detail['conditional'][$c]['v4']['prob'], 4) }}</div>
                        <div class="mt-2 border-top border-secondary border-opacity-30 pt-2 fw-bold">
                            = <span class="text-info">{{ number_format($detail['score'][$c], 6) }}</span> 
                            <span class="text-white opacity-50 mx-1">➔</span> 
                            <span class="text-success">Persentase Akurasi Akhir: {{ number_format($detail['percentage'][$c], 2) }}%</span>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card border border-light-subtle shadow-sm rounded-4 overflow-hidden mb-2">
    <div class="card-header bg-dark text-white fw-bold py-3 px-4 d-flex align-items-center gap-2">
        <i class="fa-solid fa-square-check text-success"></i>
        <span>Kesimpulan Akhir Klasifikasi</span>
    </div>
    
    @if($history->hasil_keputusan === 'Baik')
        <a href="{{ route('about') }}" class="card-body d-block text-center text-decoration-none py-5 bg-success bg-opacity-10 border-top border-success border-opacity-10 info-card-link">
            <span class="text-muted small text-uppercase fw-bold d-block mb-1" style="letter-spacing: 0.05em;">Hasil Keputusan Probabilitas Tertinggi (Klik untuk Detail Kriteria)</span>
            <h1 class="fw-extrabold text-success my-2 display-5" style="font-weight: 800;"><i class="fa-solid fa-circle-check me-2"></i>KATEGORI: {{ strtoupper($history->hasil_keputusan) }}</h1>
            <p class="text-secondary mt-3 mb-0" style="font-size: 1.05rem;">
                Bibit tanaman pisang raja ini secara sistem diklasifikasikan ke dalam kategori kualitas <strong class="text-dark">{{ $history->hasil_keputusan }}</strong>.
            </p>
        </a>
    @elseif($history->hasil_keputusan === 'Sedang')
        <a href="{{ route('about') }}" class="card-body d-block text-center text-decoration-none py-5 bg-warning bg-opacity-10 border-top border-warning border-opacity-10 info-card-link">
            <span class="text-muted small text-uppercase fw-bold d-block mb-1" style="letter-spacing: 0.05em;">Hasil Keputusan Probabilitas Tertinggi (Klik untuk Detail Kriteria)</span>
            <h1 class="fw-extrabold text-warning my-2 display-5" style="font-weight: 800; color: #664d03 !important;"><i class="fa-solid fa-triangle-exclamation me-2"></i>KATEGORI: {{ strtoupper($history->hasil_keputusan) }}</h1>
            <p class="text-secondary mt-3 mb-0" style="font-size: 1.05rem;">
                Bibit tanaman pisang raja ini secara sistem diklasifikasikan ke dalam kategori kualitas <strong class="text-dark">{{ $history->hasil_keputusan }}</strong>.
            </p>
        </a>
    @else
        <a href="{{ route('about') }}" class="card-body d-block text-center text-decoration-none py-5 bg-danger bg-opacity-10 border-top border-danger border-opacity-10 info-card-link">
            <span class="text-muted small text-uppercase fw-bold d-block mb-1" style="letter-spacing: 0.05em;">Hasil Keputusan Probabilitas Tertinggi (Klik untuk Detail Kriteria)</span>
            <h1 class="fw-extrabold text-danger my-2 display-5" style="font-weight: 800;"><i class="fa-solid fa-circle-xmark me-2"></i>KATEGORI: {{ strtoupper($history->hasil_keputusan) }}</h1>
            <p class="text-secondary mt-3 mb-0" style="font-size: 1.05rem;">
                Bibit tanaman pisang raja ini secara sistem diklasifikasikan ke dalam kategori kualitas <strong class="text-dark">{{ $history->hasil_keputusan }}</strong>.
            </p>
        </a>
    @endif
</div>

<style>
    /* Animasi halus saat box kesimpulan disorot kursor */
    .info-card-link {
        transition: all 0.2s ease-in-out;
    }
    .info-card-link:hover {
        background-color: rgba(0, 0, 0, 0.03) !important;
        transform: translateY(-1px);
    }
</style>
@endsection