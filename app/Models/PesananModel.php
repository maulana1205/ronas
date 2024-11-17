<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class Pesanan extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->transaksiModel = new TransaksiModel(); // Model transaksi
    }

    // Menampilkan daftar pesanan
    public function index()
    {
        $userId = $this->session->get('user_id'); // Mengambil ID pengguna dari session

        if (!$userId) {
            return redirect()->to('auth/login'); // Jika tidak ada user_id di session, redirect ke login
        }

        // Ambil pesanan berdasarkan user_id
        $pesanan = $this->transaksiModel->getPesananByUser($userId);

        return view('pesanan/index', ['pesanan' => $pesanan]);
    }

    // Menampilkan detail pesanan berdasarkan ID pesanan
    public function detail($id)
    {
        $pesanan = $this->transaksiModel->find($id); // Ambil data pesanan berdasarkan ID

        if (!$pesanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('pesanan/detail', ['pesanan' => $pesanan]);
    }
}
