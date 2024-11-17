<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePesananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pesanan' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'INT',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'tanggal' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id_pesanan', true);
        $this->forge->createTable('pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pesanan');
    }
}
