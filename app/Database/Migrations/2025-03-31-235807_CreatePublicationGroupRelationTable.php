<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePublicationGroupRelationTable extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'constraint' => 11,
        'auto_increment' => true,
      ],
      'group_id' => [
        'type' => 'INT',
      ],
      'publication_id' => [
        'type' => 'INT',
      ],
    ]);

    $this->forge->addPrimaryKey('id');

    $this->forge->createTable('publication_groups');
  }

  public function down()
  {
    $this->forge->dropTable('publication_groups');
  }
}
