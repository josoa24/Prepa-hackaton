<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGroupMemberTable extends Migration
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
        'null'       => false,
      ],
      'user_id' => [
        'type'       => 'INT',
        'constraint' => 11,
        'unsigned'   => true,
        'null'       => false,
      ],
      'role' => [
        'type'       => 'ENUM',
        'constraint' => ['admin', 'member'],
        'default'    => 'member',
      ],
      'joined_at' => [
        'type' => 'DATETIME',
        'null' => false,
      ],
    ]);

    $this->forge->addPrimaryKey(['id', 'group_id', 'user_id']);
    $this->forge->createTable('group_members');
  }

  public function down()
  {
    $this->forge->dropTable('group_members');
  }
}
