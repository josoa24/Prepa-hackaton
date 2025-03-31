<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'last_name'      => 'Doe',
                'first_name'     => 'John',
                'address'        => '123 Main St',
                'country'        => 'USA',
                'email'          => 'john.doe@example.com',
                'phone_number'   => '123-456-7890',
                'password'       => 'password123',
                'profile_picture'=> null
            ],
            [
                'last_name'      => 'Smith',
                'first_name'     => 'Jane',
                'address'        => '456 Elm St',
                'country'        => 'Canada',
                'email'          => 'jane.smith@example.com',
                'phone_number'   => '987-654-3210',
                'password'       => 'securepass456',
                'profile_picture'=> null
            ],
            [
                'last_name'      => 'Brown',
                'first_name'     => 'Charlie',
                'address'        => '789 Oak St',
                'country'        => 'UK',
                'email'          => 'charlie.brown@example.com',
                'phone_number'   => '555-555-5555',
                'password'       => 'mypassword789',
                'profile_picture'=> null
            ],
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
