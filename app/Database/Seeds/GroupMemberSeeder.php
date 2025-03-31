<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupMemberSeeder extends Seeder
{
  public function run()
  {
    $data = [
      [
        'group_id' => 1,
        'user_id' => 1,
        'role' => 'admin',
        'joined_at' => date('Y-m-d H:i:s'),
      ],
      [
        'group_id' => 1,
        'user_id' => 2,
        'role' => 'member',
        'joined_at' => date('Y-m-d H:i:s'),
      ],
      [
        'group_id' => 1,
        'user_id' => 3,
        'role' => 'member',
        'joined_at' => date('Y-m-d H:i:s'),
      ],
      [
        'group_id' => 2,
        'user_id' => 3,
        'role' => 'admin',
        'joined_at' => date('Y-m-d H:i:s'),
      ],
      [
        'group_id' => 2,
        'user_id' => 4,
        'role' => 'member',
        'joined_at' => date('Y-m-d H:i:s'),
      ],
    ];

    // Insert data into the database
    $this->db->table('group_members')->insertBatch($data);
  }
}
