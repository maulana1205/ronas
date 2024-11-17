<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTransaksiForeignKeyToPesanan extends Migration
{
    public function up()
    {
        // Pastikan kolom 'id_transaksi' sudah ada, jadi hanya menambahkan foreign key
        // Menambahkan foreign key untuk 'id_transaksi' yang merujuk ke tabel 'transaksi'
        $this->forge->addForeignKey('id_transaksi', 'transaksi', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Menghapus foreign key dari kolom 'id_transaksi'
        $this->forge->dropForeignKey('pesanan', 'pesanan_id_transaksi_foreign');
    }
}
