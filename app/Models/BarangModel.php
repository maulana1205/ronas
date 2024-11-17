<?php namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'harga', 'stok', 'gambar', 'created_by', 'created_date', 'updated_date', 'updated_by', 'deskripsi'
    ];
    protected $returnType = 'App\Entities\Barang';  // Kapitalisasi disesuaikan
    protected $useTimestamps = false;  // Jika tidak ingin timestamp otomatis
}
