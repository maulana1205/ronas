<?php 

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Transaksi extends Entity
{
    protected $id;
    protected $id_barang;
    protected $id_pembeli;
    protected $jumlah;
    protected $total_harga;
    protected $created_by;
    protected $created_date;
    protected $updated_by;
    protected $updated_date;
    protected $alamat;
    protected $ongkir;
    protected $status;

    // Getter dan setter untuk setiap properti jika diperlukan
    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function setId(int $id)
    {
        $this->attributes['id'] = $id;
    }

    // Definisikan getter dan setter untuk properti lainnya sesuai kebutuhan
}
