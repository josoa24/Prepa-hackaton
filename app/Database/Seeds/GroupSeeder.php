<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupSeeder extends Seeder
{
  public function run()
  {
    $data = [
      [
        'name'        => 'Group A',
        'description' => 'This is the first group.',
        'created_at'  => date('Y-m-d H:i:s'),
        'admin_id'    => 1,
      ],
      [
        'name'        => 'Group B',
        'description' => 'This is the second group.',
        'created_at'  => date('Y-m-d H:i:s'),
        'admin_id'    => 2,
      ],
    ];

    $this->db->table('groups')->insertBatch($data);
  }
}
