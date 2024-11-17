<?php namespace App\Controllers;

use App\Models\TransaksiModel;

class Pesanan extends BaseController
{
    public function index()
    {
        // Ambil user_id dari session
        $userId = session()->get('user_id');
        if (!$userId) {
            return "User ID tidak ditemukan. Silakan login terlebih dahulu.";
        }

        // Ambil role pengguna dari session
        $role = session()->get('role'); // Misalnya role disimpan di session

        // Inisialisasi model transaksi
        $transaksiModel = new TransaksiModel();

        // Jika role adalah 'user', filter transaksi hanya untuk user tersebut
        if ($role === 'user') {
            $transaksi = $transaksiModel->where('id_pembeli', $userId)
                                        ->orderBy('created_date', 'DESC')
                                        ->findAll();
        } else {
            // Jika admin, tampilkan semua transaksi
            $transaksi = $transaksiModel->orderBy('created_date', 'DESC')
                                        ->findAll();
        }

        // Cek apakah transaksi ditemukan
        if (empty($transaksi)) {
            return "Anda belum memiliki riwayat pesanan.";
        }

        // Pass data transaksi ke view
        return view('pesanan/index', ['model' => $transaksi]);
    }
}
