<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();

        // Cek apakah user sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        // Cek apakah user adalah admin
        if ($session->get('role') != 'admin') {
            return redirect()->to('/dashboard/index');
        }

        // Mengambil data transaksi dari model
        $transaksiModel = new TransaksiModel();
        $transaksiData = $transaksiModel->findAll();

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Dashboard',
            'username' => $session->get('username'),
            'transaksiData' => $transaksiData
        ];

        return view('dashboard/index', $data);
    }
}
