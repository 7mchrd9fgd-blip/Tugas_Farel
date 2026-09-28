@extends('user.layout')

@section('content')
<div class="d-flex align-items-center gap-3 mb-2">
    <div class="bg-success bg-opacity-10 p-3 rounded-4 text-success">
        <i class="fa-solid fa-pen-to-square fs-3"></i>
    </div>
    <div>
        <h3 class="fw-bold text-dark m-0" style="font-size: 1.75rem;">Input Keputusan Kriteria Bibit Pisang Raja</h3>
        <p class="text-muted small m-0 mt-1">Silakan tentukan penilaian kondisi fisik karakteristik bibit pisang raja skala 1 (Terendah) sampai dengan skala 5 (Tertinggi).</p>
    </div>
</div>

<hr class="text-muted opacity-25 my-4">

@if($errors->any())
    <div class="alert alert-danger border-0 shadow-sm rounded-4 small d-flex align-items-center gap-3 mb-4 p-3.5">
        <i class="fa-solid fa-triangle-exclamation fs-4"></i>
        <div class="fw-medium">{{ $errors->first() }}</div>
    </div>
@endif

<div class="py-2">
    <form action="{{ route('user.hitung') }}" method="POST">
        @csrf
        <div class="row g-4">
            
            <div class="col-12">
                <div class="card p-4 border border-light-subtle shadow-sm rounded-4 bg-light bg-opacity-50">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                        <label class="form-label fw-bold text-dark m-0 d-flex align-items-center gap-2" style="font-size: 1.15rem;">
                            <span class="badge bg-success px-3 py-2 rounded-3" style="font-size: 0.9rem;">V1</span> Tinggi Bibit Tanaman
                        </label>
                    </div>
                    <select name="v1" class="form-select form-select-lg border-light-subtle text-dark fw-medium" style="font-size: 1.1rem; padding: 1.1rem 1.5rem; border-radius: 14px; background-color: #ffffff; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);" required>
                        <option value="" class="text-muted">-- Pilih Nilai Karakteristik Tinggi V1 --</option>
                        <option value="1">1 - Tidak Baik (Kondisi pertumbuhan sangat kerdil / terhambat)</option>
                        <option value="2">2 - Kurang Baik (Tinggi tanaman di bawah standar rata-rata)</option>
                        <option value="3">3 - Sedang (Memenuhi standar tinggi minimum pengujian)</option>
                        <option value="4">4 - Baik (Tinggi ideal sesuai usia vegetatif bibit)</option>
                        <option value="5">5 - Sangat Baik (Pertumbuhan sangat optimal dan tegak kokoh)</option>
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="card p-4 border border-light-subtle shadow-sm rounded-4 bg-light bg-opacity-50">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                        <label class="form-label fw-bold text-dark m-0 d-flex align-items-center gap-2" style="font-size: 1.15rem;">
                            <span class="badge bg-success px-3 py-2 rounded-3" style="font-size: 0.9rem;">V2</span> Warna Daun Klorofil
                        </label>
                    </div>
                    <select name="v2" class="form-select form-select-lg border-light-subtle text-dark fw-medium" style="font-size: 1.1rem; padding: 1.1rem 1.5rem; border-radius: 14px; background-color: #ffffff; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);" required>
                        <option value="" class="text-muted">-- Pilih Nilai Karakteristik Daun V2 --</option>
                        <option value="1">1 - Tidak Baik (Daun layu kekuningan / mengalami klorosis parah)</option>
                        <option value="2">2 - Kurang Baik (Bercak noda atau pigmentasi kurang sehat)</option>
                        <option value="3">3 - Sedang (Warna hijau standar, sedikit gradasi pudar)</option>
                        <option value="4">4 - Baik (Hijau cerah merata tanpa indikasi penyakit)</option>
                        <option value="5">5 - Sangat Baik (Hijau pekat, segar, mengkilap, dan sangat sehat)</option>
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="card p-4 border border-light-subtle shadow-sm rounded-4 bg-light bg-opacity-50">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                        <label class="form-label fw-bold text-dark m-0 d-flex align-items-center gap-2" style="font-size: 1.15rem;">
                            <span class="badge bg-success px-3 py-2 rounded-3" style="font-size: 0.9rem;">V3</span> Kondisi Jaringan Akar
                        </label>
                    </div>
                    <select name="v3" class="form-select form-select-lg border-light-subtle text-dark fw-medium" style="font-size: 1.1rem; padding: 1.1rem 1.5rem; border-radius: 14px; background-color: #ffffff; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);" required>
                        <option value="" class="text-muted">-- Pilih Nilai Karakteristik Akar V3 --</option>
                        <option value="1">1 - Tidak Baik (Akar rapuh, sedikit, atau terindikasi pembusukan)</option>
                        <option value="2">2 - Kurang Baik (Pertumbuhan serabut akar kurang menyebar)</option>
                        <option value="3">3 - Sedang (Akar cukup kuat mengikat media tanam)</option>
                        <option value="4">4 - Baik (Sistem perakaran lebat, putih bersih, dan aktif)</option>
                        <option value="5">5 - Sangat Baik (Akar primer dan sekunder sangat kokoh dan masif)</option>
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="card p-4 border border-light-subtle shadow-sm rounded-4 bg-light bg-opacity-50">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                        <label class="form-label fw-bold text-dark m-0 d-flex align-items-center gap-2" style="font-size: 1.15rem;">
                            <span class="badge bg-success px-3 py-2 rounded-3" style="font-size: 0.9rem;">V4</span> Ketebalan Batang Utama
                        </label>
                    </div>
                    <select name="v4" class="form-select form-select-lg border-light-subtle text-dark fw-medium" style="font-size: 1.1rem; padding: 1.1rem 1.5rem; border-radius: 14px; background-color: #ffffff; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);" required>
                        <option value="" class="text-muted">-- Pilih Nilai Karakteristik Batang V4 --</option>
                        <option value="1">1 - Tidak Baik (Batang terlalu kurus, lembek, dan rapuh)</option>
                        <option value="2">2 - Kurang Baik (Diameter batang di bawah spesifikasi standar)</option>
                        <option value="3">3 - Sedang (Ketebalan batang proporsional standar umum)</option>
                        <option value="4">4 - Baik (Batang tebal, padat, dan tahan tiupan angin)</option>
                        <option value="5">5 - Sangat Baik (Struktur bonggol dan batang sangat besar & solid)</option>
                    </select>
                </div>
            </div>
            
        </div>
        
        <div class="mt-5 pt-3 d-flex flex-column flex-sm-row justify-content-end gap-3">
            <button type="reset" class="btn btn-light border-light-subtle px-5 py-3 fw-semibold text-secondary" style="border-radius: 12px; font-size: 1rem;">
                <i class="fa-solid fa-arrow-rotate-left me-2"></i> Reset Isi Form
            </button>
            <button type="submit" class="btn btn-success px-5 py-3 fw-bold shadow" style="background: linear-gradient(90deg, #198754 0%, #157347 100%); border: none; border-radius: 12px; font-size: 1.05rem;">
                <i class="fa-solid fa-calculator me-2"></i> Jalankan Eksekusi Hitung Kualitas
            </button>
        </div>
    </form>
</div>
@endsection