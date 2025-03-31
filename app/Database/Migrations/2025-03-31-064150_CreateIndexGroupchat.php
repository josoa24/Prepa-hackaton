<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIndexGroupchat extends Migration
{
  public function up()
  {
    $this->db->query('CREATE INDEX idx_group_member ON group_members(group_id, user_id);');
    $this->db->query('CREATE INDEX idx_message_group ON messages(group_id);');
    $this->db->query('CREATE INDEX idx_message_timestamp ON messages(timestamp);');
  }

  public function down()
  {
    $this->db->query('DROP INDEX idx_group_member ON group_members;');
    $this->db->query('DROP INDEX idx_message_group ON messages;');
    $this->db->query('DROP INDEX idx_message_timestamp ON messages;');
  }
}
