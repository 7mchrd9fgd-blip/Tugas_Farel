<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Menampilkan Halaman Dashboard Analisis & Statistik
    public function index()
    {
        // 1. Menghitung Total Data Latih Keseluruhan
        $totalDataLatih = DB::table('data_trainings')->count();

        // 2. Menghitung Total Data Latih per Kelas Kualitas
        $totalBaik = DB::table('data_trainings')->where('kelas', 'Baik')->count();
        $totalSedang = DB::table('data_trainings')->where('kelas', 'Sedang')->count();
        $totalTidakBaik = DB::table('data_trainings')->where('kelas', 'Tidak Baik')->count();

        // 3. Menghitung Total Seluruh Pengujian dari tabel 'histories'
        $totalRiwayatUser = DB::table('histories')->count();

        // 4. PERBAIKAN: Menghitung Total User Terdaftar (agar tampilan kartu seimbang)
        $totalUser = DB::table('users')->where('role', 'user')->count();

        return view('admin.dashboard', compact(
            'totalDataLatih',
            'totalBaik',
            'totalSedang',
            'totalTidakBaik',
            'totalRiwayatUser',
            'totalUser'
        ));
    }

    // Menampilkan Tabel Data Latih dengan Pagination (10 data per halaman)
    public function dataTrainingIndex()
    {
        $dataLatih = DB::table('data_trainings')->paginate(10);
        return view('admin.data_training.index', compact('dataLatih'));
    }

    // Menampilkan Form Tambah Data Latih
    public function dataTrainingCreate()
    {
        return view('admin.data_training.create');
    }

    // Menyimpan Data Latih Baru ke Database
    public function dataTrainingStore(Request $request)
    {
        $request->validate([
            'v1' => 'required|numeric',
            'v2' => 'required|numeric',
            'v3' => 'required|numeric',
            'v4' => 'required|numeric',
            'kelas' => 'required|in:Baik,Sedang,Tidak Baik',
        ]);

        DB::table('data_trainings')->insert([
            'v1' => $request->v1,
            'v2' => $request->v2,
            'v3' => $request->v3,
            'v4' => $request->v4,
            'kelas' => $request->kelas,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.data_training.index')->with('success', 'Data latih baru berhasil ditambahkan!');
    }

    // Menampilkan Form Ubah/Edit Data Latih berdasarkan ID
    public function dataTrainingEdit(int $id)
    {
        $data = DB::table('data_trainings')->where('id', $id)->first();
        
        if (!$data) {
            return redirect()->route('admin.data_training.index')->with('error', 'Data tidak ditemukan!');
        }

        return view('admin.data_training.edit', compact('data'));
    }

    // Memproses Pembaruan Data Latih ke Database
    public function dataTrainingUpdate(Request $request, int $id)
    {
        $request->validate([
            'v1' => 'required|numeric',
            'v2' => 'required|numeric',
            'v3' => 'required|numeric',
            'v4' => 'required|numeric',
            'kelas' => 'required|in:Baik,Sedang,Tidak Baik',
        ]);

        DB::table('data_trainings')->where('id', $id)->update([
            'v1' => $request->v1,
            'v2' => $request->v2,
            'v3' => $request->v3,
            'v4' => $request->v4,
            'kelas' => $request->kelas,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.data_training.index')->with('success', 'Data latih berhasil diperbarui!');
    }

    // Menghapus Data Latih dari Database
    public function dataTrainingDestroy(int $id)
    {
        DB::table('data_trainings')->where('id', $id)->delete();
        return redirect()->route('admin.data_training.index')->with('success', 'Data latih berhasil dihapus!');
    }

    // ◄ PENYESUAIAN: Menampilkan Halaman Riwayat Global Pengujian Seluruh User
    public function riwayatGlobal()
    {
        // Mengambil data dari tabel histories, dihubungkan ke tabel users 
        // untuk mengetahui nama user yang melakukan pengujian.
        $riwayatGlobal = DB::table('histories')
            ->leftJoin('users', 'histories.user_id', '=', 'users.id')
            ->select('histories.*', 'users.name as nama_user')
            ->orderBy('histories.created_at', 'desc')
            ->paginate(10);

        return view('admin.riwayat', compact('riwayatGlobal'));
    }
}