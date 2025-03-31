<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCanvasStatesTable extends Migration
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
      'group_id' => [
        'type'       => 'INT',
        'constraint' => 11,
        'unsigned'   => true,
      ],
      'canvas_json' => [
        'type' => 'TEXT',
        'null' => true,
      ],
      'timestamp' => [
        'type' => 'DATETIME',
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('canvas_states');
  }

  public function down()
  {
    $this->forge->dropTable('canvas_states');
  }
}
