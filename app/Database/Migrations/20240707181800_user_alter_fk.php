<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserRole extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('user', [
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['user', 'admin'],
                'default' => 'user',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('user', [
            'role' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 1,
            ],
        ]);
    }
}
?>