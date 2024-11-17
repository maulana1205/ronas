<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterStatusColumnInTransaksi extends Migration
{
    public function up()
    {
        // Mengubah kolom 'status' menjadi ENUM dengan nilai yang ditentukan
        $this->forge->modifyColumn('transaksi', [
            'status' => [
                'name'           => 'status',  // Nama kolom yang akan diubah
                'type'           => 'ENUM',
                'constraint'     => ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'],
                'default'        => 'pending',  // Nilai default
            ]
        ]);
    }

    public function down()
    {
        // Kembalikan perubahan dengan mengubah kolom 'status' ke tipe yang sebelumnya
        $this->forge->modifyColumn('transaksi', [
            'status' => [
                'name'           => 'status',
                'type'           => 'VARCHAR',  // Tipe sebelumnya, misalnya VARCHAR
                'constraint'     => '255',  // Sesuaikan dengan panjang karakter sebelumnya
                'null'           => true,  // Sesuaikan dengan pengaturan sebelumnya
            ]
        ]);
    }
}
