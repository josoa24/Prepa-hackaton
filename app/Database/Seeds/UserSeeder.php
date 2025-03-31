<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run()
  {
    $data = [];

    for ($i = 1; $i <= 10; $i++) {
      $data[] = [
        'last_name'    => "LastName$i",
        'first_name'   => "FirstName$i",
        'address'      => "Address $i",
        'country'      => "Country $i",
        'email'        => "user$i@example.com",
        'phone_number' => "123456789$i",
        'password'     => "password123",
      ];
    }

    $this->db->table('i_colab_user')->insertBatch($data);
  }
}
