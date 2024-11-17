<?php
namespace App\Controllers;

class Etalase extends BaseController
{
    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "8716adf273dd14e8a303b62268fd62c7";

    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        $barang = new \App\Models\BarangModel();
        $model = $barang->findAll();
        return view('etalase/index', [
            'model' => $model,
        ]);
    }

    public function beli()
    {
        $id = $this->request->geturi()->getSegment(3);

        $modelBarang = new \App\Models\BarangModel();
        $modelKomentar = new \App\Models\KomentarModel();
        $komentar = $modelKomentar->where('id_barang', $id)->findAll();
        $model = $modelBarang->find($id);

        $provinsi = $this->rajaongkir('province');

        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'transaksi');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                // Menyimpan transaksi
                $transaksiModel = new \App\Models\TransaksiModel();
                $transaksi = new \App\Entities\Transaksi();

                // Update stok barang
                $barangModel = new \App\Models\BarangModel();
                $id_barang = $this->request->getPost('id_barang');
                $jumlah_pembelian = $this->request->getPost('jumlah');
                $barang = $barangModel->find($id_barang);
                $barang->stok -= $jumlah_pembelian;
                $barangModel->save($barang);

                $transaksi->fill($data);
                $transaksi->status = 0; // 0 = Belum Dibayar
                $transaksi->created_by = $this->session->get('id');
                $transaksi->created_date = date("Y-m-d H:i:s");
                $transaksiModel->save($transaksi);

                $id_transaksi = $transaksiModel->insertID();
                $segment = ['etalase', 'payment', $id_transaksi];

                return redirect()->to(site_url($segment));
            }
        }

        return view('etalase/beli', [
            'model' => $model,
            'komentar' => $komentar,
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ]);
    }

    public function payment($id_transaksi)
    {
        // Mengambil data transaksi
        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = $transaksiModel->find($id_transaksi);

        if (!$transaksi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi tidak ditemukan");
        }

        // Menambahkan total harga pada view payment
        $total_harga = $transaksi->total_harga;

        if ($this->request->getPost()) {
            // Validasi metode pembayaran
            $data = $this->request->getPost();
            $this->validation->run($data, 'pembayaran');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                // Simpan detail pembayaran dan update status transaksi
                $transaksi->metode_pembayaran = $this->request->getPost('metode_pembayaran');
                $transaksi->status = 1; // 1 = Sudah Dibayar
                $transaksiModel->save($transaksi);

                // Kirim email konfirmasi atau notifikasi jika diperlukan

                $segment = ['transaksi', 'view', $id_transaksi];
                return redirect()->to(site_url($segment));
            }
        }

        return view('etalase/payment', [
            'transaksi' => $transaksi,
            'total_harga' => $total_harga, // Mengirim total harga ke view payment
        ]);
    }

    // Method untuk mendapatkan daftar kota berdasarkan provinsi
    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    // Method untuk mendapatkan ongkos kirim
    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }

    private function rajaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;

        if ($id_province != null) {
            $endPoint = $endPoint . "?province=" . $id_province;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
