<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateParticipationTable extends Migration
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
      'id_publication' => [
        'type'       => 'INT',
        'constraint' => 11,
        'unsigned'   => true,
        'null'       => false,
      ],
      'id_user' => [
        'type'       => 'INT',
        'constraint' => 11,
        'unsigned'   => true,
        'null'       => false,
      ],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('i_colab_colaboration');
  }

  public function down()
  {
    $this->forge->dropTable('i_colab_colaboration');
  }
}
