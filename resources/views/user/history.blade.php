@extends('user.layout')

@section('content')
@php
    $keterangan = [
        1 => 'Tidak Baik',
        2 => 'Kurang Baik',
        3 => 'Sedang',
        4 => 'Baik',
        5 => 'Sangat Baik'
    ];
@endphp

<div class="d-flex align-items-center gap-3 mb-2">
    <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success">
        <i class="fa-solid fa-clock-rotate-left fs-4"></i>
    </div>
    <h4 class="fw-bold text-dark m-0">Riwayat Hasil Keputusan Klasifikasi</h4>
</div>
<p class="text-muted small mb-4">Berikut adalah log daftar seluruh pengujian data matriks kualitas tanaman yang tersimpan aman di dalam database sistem:</p>

<hr class="text-muted opacity-25 mb-4">

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 small d-flex align-items-center gap-2 p-3 mb-4">
        <i class="fa-solid fa-circle-check fs-5"></i>
        <div>{{ session('success') }}</div>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm rounded-3 small d-flex align-items-center gap-2 p-3 mb-4">
        <i class="fa-solid fa-circle-exclamation fs-5"></i>
        <div>{{ session('error') }}</div>
    </div>
@endif

<div class="table-responsive border border-light-subtle rounded-4 shadow-sm bg-white overflow-hidden mt-3">
    <table class="table table-hover align-middle m-0 text-center" style="font-size: 0.9rem;">
        <thead class="bg-light border-bottom border-light-subtle text-secondary fw-bold">
            <tr>
                <th class="py-3 px-3 text-dark fw-bold" style="font-size: 0.85rem; width: 60px;">No</th>
                <th class="py-3 text-dark fw-bold" style="font-size: 0.85rem;">Tanggal Uji</th>
                <th class="py-3 text-dark fw-bold" style="font-size: 0.85rem;">V1 (Tinggi)</th>
                <th class="py-3 text-dark fw-bold" style="font-size: 0.85rem;">V2 (Daun)</th>
                <th class="py-3 text-dark fw-bold" style="font-size: 0.85rem;">V3 (Akar)</th>
                <th class="py-3 text-dark fw-bold" style="font-size: 0.85rem;">V4 (Batang)</th>
                <th class="py-3 text-dark fw-bold" style="font-size: 0.85rem;">Hasil Keputusan</th>
                <th class="py-3 px-3 text-dark fw-bold" style="font-size: 0.85rem; width: 160px;">Aksi</th>
            </tr>
        </thead>
        <tbody class="border-0">
            @forelse($histories as $index => $row)
                <tr style="transition: background-color 0.15s ease;">
                    <td class="py-3 fw-medium text-secondary">{{ $index + 1 }}</td>
                    <td class="py-3 text-dark fw-medium small">{{ date('d-m-Y H:i', strtotime($row->created_at)) }} WIB</td>
                    
                    <td class="py-3"><span class="badge bg-light text-dark border border-light-subtle py-2 px-2.5 rounded-3 fw-normal">{{ $keterangan[$row->v1] ?? $row->v1 }}</span></td>
                    <td class="py-3"><span class="badge bg-light text-dark border border-light-subtle py-2 px-2.5 rounded-3 fw-normal">{{ $keterangan[$row->v2] ?? $row->v2 }}</span></td>
                    <td class="py-3"><span class="badge bg-light text-dark border border-light-subtle py-2 px-2.5 rounded-3 fw-normal">{{ $keterangan[$row->v3] ?? $row->v3 }}</span></td>
                    <td class="py-3"><span class="badge bg-light text-dark border border-light-subtle py-2 px-2.5 rounded-3 fw-normal">{{ $keterangan[$row->v4] ?? $row->v4 }}</span></td>
                    
                    <td class="py-3">
                        @if($row->hasil_keputusan === 'Baik')
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-10 py-2 px-3 rounded-pill fw-bold" style="font-size: 0.85rem;">Baik</span>
                        @elseif($row->hasil_keputusan === 'Sedang')
                            <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning border-opacity-20 py-2 px-3 rounded-pill fw-bold" style="font-size: 0.85rem;">Sedang</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 py-2 px-3 rounded-pill fw-bold" style="font-size: 0.85rem;">Tidak Baik</span>
                        @endif
                    </td>
                    
                    <td class="py-3 px-3">
                        <a href="{{ route('user.history.detail', $row->id) }}" class="btn btn-sm btn-white border border-light-subtle text-success fw-bold py-1.5 px-3 rounded-3 shadow-sm d-inline-flex align-items-center gap-1.5 btn-action-hover" style="font-size: 0.8rem; background-color: #ffffff;">
                            <i class="fa-solid fa-magnifying-glass-chart text-success-custom"></i> Detail Rumus
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-muted text-center py-5">
                        <div class="mb-2"><i class="fa-regular fa-folder-open fs-2 opacity-50"></i></div>
                        <span class="small fw-medium">Belum ada riwayat pengujian data matriks keputusan.</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    /* Efek hover dinamis pada baris tabel & tombol */
    .btn-action-hover:hover {
        background-color: #198754 !important;
        color: #ffffff !important;
        border-color: #198754 !important;
    }
    .btn-action-hover:hover i {
        color: #ffffff !important;
    }
</style>
@endsection