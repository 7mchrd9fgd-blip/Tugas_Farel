<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // 1. Halaman Panduan / Langkah Penggunaan
    public function index()
    {
        return view('user.dashboard');
    }

    // 2. Tampilan Form Input Matriks Keputusan
    public function showForm()
    {
        return view('user.input_matriks');
    }

    // 3. Process Perhitungan Naïve Bayes + Laplace Smoothing
    public function hitung(Request $request)
    {
        $request->validate([
            'v1' => 'required|integer|between:1,5',
            'v2' => 'required|integer|between:1,5',
            'v3' => 'required|integer|between:1,5',
            'v4' => 'required|integer|between:1,5',
        ]);

        $v1 = (int)$request->v1;
        $v2 = (int)$request->v2;
        $v3 = (int)$request->v3;
        $v4 = (int)$request->v4;

        // Ambil total data training secara real-time dari database
        $totalData = DB::table('data_trainings')->count();
        
        $classes = ['Baik', 'Sedang', 'Tidak Baik'];
        $prior = [];
        $countClass = [];
        $conditional = [];
        $score = [];

        // Definisi jumlah variasi nilai sub-kriteria (skala 1 s.d 5, maka |V| = 5)
        $V_domain = 5;

        foreach ($classes as $c) {
            // Hitung jumlah data per kelas
            $countC = DB::table('data_trainings')->where('kelas', $c)->count();
            $countClass[$c] = $countC;
            
            // 1. Probabilitas Prior P(Y)
            $prior[$c] = $totalData > 0 ? $countC / $totalData : 0;

            // Hitung frekuensi kemunculan nilai input pada data training untuk masing-masing kriteria
            $countV1 = DB::table('data_trainings')->where('kelas', $c)->where('v1', $v1)->count();
            $countV2 = DB::table('data_trainings')->where('kelas', $c)->where('v2', $v2)->count();
            $countV3 = DB::table('data_trainings')->where('kelas', $c)->where('v3', $v3)->count();
            $countV4 = DB::table('data_trainings')->where('kelas', $c)->where('v4', $v4)->count();

            // 2. Probabilitas Kondisional P(Xi|Y) dengan Laplace Smoothing: (count + 1) / (total_kelas + |V|)
            $pV1 = ($countV1 + 1) / ($countC + $V_domain);
            $pV2 = ($countV2 + 1) / ($countC + $V_domain);
            $pV3 = ($countV3 + 1) / ($countC + $V_domain);
            $pV4 = ($countV4 + 1) / ($countC + $V_domain);

            $conditional[$c] = [
                'v1' => ['count' => $countV1, 'prob' => $pV1],
                'v2' => ['count' => $countV2, 'prob' => $pV2],
                'v3' => ['count' => $countV3, 'prob' => $pV3],
                'v4' => ['count' => $countV4, 'prob' => $pV4],
            ];

            // 3. Nilai Akhir Perkalian Probabilitas
            $score[$c] = $prior[$c] * $pV1 * $pV2 * $pV3 * $pV4;
        }

        // 4. Normalisasi Hasil Akhir Menjadi Persentase
        $totalScore = array_sum($score);
        $percentage = [];
        foreach ($classes as $c) {
            $percentage[$c] = $totalScore > 0 ? ($score[$c] / $totalScore) * 100 : 0;
        }

        // Tentukan hasil keputusan berdasarkan nilai tertinggi
        $hasil_keputusan = 'Baik';
        if ($score['Sedang'] > $score[$hasil_keputusan]) {
            $hasil_keputusan = 'Sedang';
        }
        if ($score['Tidak Baik'] > $score[$hasil_keputusan]) {
            $hasil_keputusan = 'Tidak Baik';
        }

        // Susun struktur JSON detail perhitungan untuk disimpan ke tabel history
        $detail_perhitungan = [
            'input' => ['v1' => $v1, 'v2' => $v2, 'v3' => $v3, 'v4' => $v4],
            'total_data' => $totalData,
            'count_class' => $countClass,
            'prior' => $prior,
            'conditional' => $conditional,
            'score' => $score,
            'percentage' => $percentage,
            'v_domain' => $V_domain
        ];

        // Mulai transaksi database agar data tersimpan konsisten di kedua tabel
        DB::transaction(function () use ($v1, $v2, $v3, $v4, $hasil_keputusan, $detail_perhitungan) {
            // Simpan ke tabel histories
            DB::table('histories')->insert([
                'user_id' => Auth::id(),
                'v1' => $v1,
                'v2' => $v2,
                'v3' => $v3,
                'v4' => $v4,
                'hasil_keputusan' => $hasil_keputusan,
                'detail_perhitungan' => json_encode($detail_perhitungan),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // KETENTUAN UTAMA: Data uji otomatis masuk menjadi Data Training baru
            DB::table('data_trainings')->insert([
                'v1' => $v1,
                'v2' => $v2,
                'v3' => $v3,
                'v4' => $v4,
                'kelas' => $hasil_keputusan,
                'is_from_user' => 1, // Penanda bahwa data ini disumbang dari input user
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }); // ◄ PERBAIKAN: Sudah ditutup menggunakan tanda }); yang benar untuk DB::transaction

        return redirect()->route('user.history')->with('success', 'Perhitungan selesai! Hasil keputusan: ' . $hasil_keputusan); // ◄ PERBAIKAN: String pesan sukses dilengkapi agar tidak memicu error terpotong
    }

    // 4. Halaman Tabel Riwayat / History Hasil Keputusan User
    public function history()
    {
        // Ambil data riwayat khusus milik user yang sedang login saat ini
        $histories = DB::table('histories')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history', compact('histories'));
    }

    // 5. Tampilan Detail Rumus Perhitungan Berdasarkan ID History yang Dipilih
    public function showDetail($id)
    {
        $history = DB::table('histories')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$history) {
            return redirect()->route('user.history')->with('error', 'Data riwayat tidak ditemukan.');
        }

        // Decode data JSON detail perhitungan agar bisa dibaca di view sebagai array
        $detail = json_decode($history->detail_perhitungan, true);

        return view('user.history_detail', compact('history', 'detail'));
    }
}