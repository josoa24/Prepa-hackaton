<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePhoto extends Migration
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
            'lien' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'id_publication' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('photos');
    }

    public function down()
    {
        $this->forge->dropTable('photos');
    }
}
