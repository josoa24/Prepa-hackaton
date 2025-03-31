<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePublication extends Migration
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
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'date_publication' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'date_evenement' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Publication');
    }

    public function down()
    {
        $this->forge->dropTable('Publication');
    }
}
