<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangAlterfk extends Migration
{
    public function up()
    {
        $fields = [
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
        ];

        $this->forge->addColumn('barang', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('barang', 'deskripsi');
    }
}
?>
