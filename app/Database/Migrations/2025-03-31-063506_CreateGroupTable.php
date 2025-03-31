<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGroupTable extends Migration
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
      'name' => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
        'null'       => false,
      ],
      'description' => [
        'type' => 'TEXT',
        'null' => true,
      ],
      'created_at' => [
        'type' => 'DATETIME', // Changed from TIMESTAMP to DATETIME
        'null' => false,
      ],
      'admin_id' => [
        'type'       => 'INT',
        'constraint' => 11,
        'unsigned'   => true,
        'null'       => false,
      ],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('groups');
  }

  public function down()
  {
    $this->forge->dropTable('groups');
  }
}
