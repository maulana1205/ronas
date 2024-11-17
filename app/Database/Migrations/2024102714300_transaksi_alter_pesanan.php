<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyToTransaksi extends Migration
{
    public function up()
    {
        // Adding the foreign key constraint without re-adding the column
        $this->db->query("
            ALTER TABLE transaksi
            ADD CONSTRAINT fk_transaksi_pesanan
            FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan)
            ON DELETE CASCADE ON UPDATE CASCADE
        ");
    }

    public function down()
    {
        // Remove the foreign key constraint if rolling back the migration
        $this->db->query("ALTER TABLE transaksi DROP FOREIGN KEY fk_transaksi_pesanan");
    }
}
