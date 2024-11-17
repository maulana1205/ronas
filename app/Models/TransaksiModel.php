<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Transaksi;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_barang', 'id_pembeli', 'jumlah', 'total_harga', 'alamat', 'ongkir', 'created_date', 'created_by', 'updated_date', 'updated_by','status'
    ];

    protected $returnType = Transaksi::class;
    protected $useTimestamps = true;

    public function getAllTransaksi()
    {
        // Jalankan query untuk mendapatkan data transaksi beserta username dari tabel user
        $query = $this->db->table($this->table)
                          ->select('transaksi.*, user.username AS nama_pembeli')
                          ->join('user', 'user.id = transaksi.id_pembeli')
                          ->get();

        // Tampilkan query terakhir untuk debugging jika diperlukan
        echo $this->db->getLastQuery();

        // Ambil hasil query
        $results = $query->getResultObject();

        // Tampilkan hasil untuk debugging
        print_r($results);

        // Return hasil query
        return $results;
    }
    public function getPesananByUser($userId)
    {
        return $this->where('id_pembeli', $userId)->findAll();
    }
}
