<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'last_name'      => 'Dupont',
                'first_name'     => 'Marie',
                'address'        => '10 Rue de Paris',
                'country'        => 'France',
                'email'          => 'marie.dupont@example.fr',
                'phone_number'   => '+33 6 12 34 56 78',
                'password'       => 'marie2023',
                'profile_picture'=> 'marie.jpg'
            ],
            [
                'last_name'      => 'Nguyen',
                'first_name'     => 'Minh',
                'address'        => '123 Nguyen Trai',
                'country'        => 'Vietnam',
                'email'          => 'minh.nguyen@example.vn',
                'phone_number'   => '+84 90 123 4567',
                'password'       => password_hash('minhsecure', PASSWORD_BCRYPT),
                'profile_picture'=> 'minh.png'
            ],
            [
                'last_name'      => 'Garcia',
                'first_name'     => 'Carlos',
                'address'        => '456 Calle Mayor',
                'country'        => 'Spain',
                'email'          => 'carlos.garcia@example.es',
                'phone_number'   => '+34 600 123 456',
                'password'       => password_hash('carlospass', PASSWORD_BCRYPT),
                'profile_picture'=> 'carlos.jpg'
            ],
            [
                'last_name'      => 'Smith',
                'first_name'     => 'Emily',
                'address'        => '789 Maple Ave',
                'country'        => 'USA',
                'email'          => 'emily.smith@example.com',
                'phone_number'   => '+1 555-123-4567',
                'password'       => password_hash('emilypass', PASSWORD_BCRYPT),
                'profile_picture'=> 'emily.png'
            ],
            [
                'last_name'      => 'Kumar',
                'first_name'     => 'Raj',
                'address'        => '12 MG Road',
                'country'        => 'India',
                'email'          => 'raj.kumar@example.in',
                'phone_number'   => '+91 98765 43210',
                'password'       => password_hash('rajsecure', PASSWORD_BCRYPT),
                'profile_picture'=> 'raj.jpg'
            ],
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
