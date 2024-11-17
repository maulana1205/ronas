<?php
namespace App\Controllers;

use App\Models\TransaksiModel; // Mengimpor model Transaksi
use App\Models\NotificationModel; // Mengimpor model Notifikasi
use App\Models\UserModel; // Mengimpor model User

class Transaksi extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    // Menampilkan halaman detail transaksi
    public function view()
    {
        $id = $this->request->getUri()->getSegment(3);

        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = $transaksiModel->select('*, transaksi.id AS id_trans')
            ->join('barang', 'barang.id=transaksi.id_barang')
            ->join('user', 'user.id=transaksi.id_pembeli')
            ->where('transaksi.id', $id)
            ->first();

        return view('transaksi/view', [
            'transaksi' => $transaksi,
        ]);
    }

    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksiModel = new \App\Models\TransaksiModel();
        $model = $transaksiModel->findAll();
        return view('Transaksi/index', [
            'model' => $model,
        ]);
    }

    // Menampilkan dan menghasilkan invoice dalam bentuk PDF
    public function invoice()
    {
        $id = $this->request->getUri()->getSegment(3);

        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = $transaksiModel->find($id);

        $userModel = new \App\Models\UserModel();
        $pembeli = $userModel->find($transaksi->id_pembeli);

        $barangModel = new \App\Models\BarangModel();
        $barang = $barangModel->find($transaksi->id_barang);

        $html = view('Transaksi/invoice', [
            'transaksi' => $transaksi,
            'pembeli' => $pembeli,
            'barang' => $barang,
        ]);

        $pdf = new \TCPDF('PDF_PAGE_ORIENTATION', PDF_UNIT, 'PDF_PAGE_FORMAT', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Admin ronas');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->addPage();

        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('invoice.pdf', 'I');
    }

    // Fungsi untuk mengonfirmasi pembayaran
    public function confirmpayment($id_transaksi = null)
    {
        // Verifikasi apakah pengguna adalah admin
        if (session()->get('role') !== 'admin') {
            // Jika bukan admin, redirect ke halaman home
            return redirect()->to(base_url('home/index'));
        }

        // Ambil data transaksi berdasarkan id_transaksi
        $transaksiModel = new TransaksiModel();
        $transaksi = $transaksiModel->where('id', $id_transaksi)->first();

        // Cek apakah transaksi ditemukan
        if (!$transaksi) {
            return redirect()->to(base_url('transaksi/index'))->with('error', 'Transaksi tidak ditemukan.');
        }

        // Cek apakah status transaksi belum dibayar
        if ($transaksi['status'] == 0) { // 0 = Belum Dibayar
            // Update status pembayaran menjadi dikonfirmasi
            $transaksiModel->update($id_transaksi, ['status' => 1]); // 1 = Sudah Dibayar

            // Menambahkan notifikasi ke pengguna
            $notificationModel = new NotificationModel();
            $notificationModel->insert([
                'id_user' => $transaksi['id_pembeli'], // id_pembeli mengacu pada pembeli
                'message' => 'Pembayaran untuk Transaksi #' . $id_transaksi . ' telah dikonfirmasi.',
                'status' => 'success'
            ]);

            // Redirect kembali ke halaman transaksi dengan pesan sukses
            return redirect()->to(base_url('transaksi/index'))->with('success', 'Pembayaran telah dikonfirmasi.');
        } else {
            // Jika pembayaran sudah dikonfirmasi sebelumnya
            return redirect()->to(base_url('transaksi/index'))->with('info', 'Pembayaran sudah dikonfirmasi sebelumnya.');
        }
    }

    // Fungsi untuk menampilkan riwayat pesanan pengguna
    public function riwayatPesanan()
    {
        $transaksiModel = new TransaksiModel();

        // Ambil ID pembeli dari session
        $id_pembeli = session()->get('id_pembeli');

        // Ambil transaksi berdasarkan ID pembeli
        $transaksi = $transaksiModel->where('id_pembeli', $id_pembeli)->findAll();

        return view('Pesanan/index', [  // Pastikan nama view sesuai
            'transaksi' => $transaksi,
        ]);
    }
}
