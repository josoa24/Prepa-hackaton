<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{

  public function run()
  {
    $datas = [];
    // for ($i = 1; $i <= 10; $i++) {
    //   $datas[] = [
    //     'first_name' => 'User' . $i,
    //     'last_name' => 'Test' . $i,
    //     'email' => 'user' . $i . '@example.com',
    //     'password' => '123',
    //     'profile_picture' => 'Josoa.jpg'
    //   ];
    // }

    $datas = [
      [
        'first_name' => 'Josoa',
        'last_name' => 'Raz',
        'email' => 'josoarazafimandimby66@gmail.com',
        'password' => '123',
        'profile_picture' => 'Josoa.jpg'
      ],
      [
        'first_name' => 'Manjaka',
        'last_name' => 'Andriantsoa',
        'email' => 'mandriantso@gmail.com',
        'password' => '123',
        'profile_picture' => 'Manjaka.jpeg'
      ],
      [
        'first_name' => 'Herana',
        'last_name' => 'Raz',
        'email' => 'razherana@gmail.com',
        'password' => '123',
        'profile_picture' => 'Herana.jpg'
      ]
    ];

    $this->db->table('user')->insertBatch($datas);
  }
}
