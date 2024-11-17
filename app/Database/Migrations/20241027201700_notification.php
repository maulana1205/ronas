<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true, // Tambahkan unsigned jika id_user adalah unsigned
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['success', 'warning', 'info', 'error'],
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null, // Menambahkan default jika diperlukan
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('notification');
    }

    public function down()
    {
        $this->forge->dropForeignKey('notification', 'notification_id_user_foreign'); // Drop foreign key
        $this->forge->dropTable('notification');
    }
}
