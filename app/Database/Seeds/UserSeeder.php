<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{

  public function run()
  {
    $datas = [];
    for ($i = 1; $i <= 10; $i++) {
      $datas[] = [
        'first_name' => 'User' . $i,
        'last_name' => 'Test' . $i,
        'email' => 'user' . $i . '@example.com',
        'password' => '123',
        'profile_picture' => 'Josoa.jpg'
      ];
    }

    $this->db->table('user')->insertBatch($datas);
  }
}
