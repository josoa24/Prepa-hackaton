<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DonSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'id_publication' => rand(1, 50),
                'id_user' => rand(1, 5),
                'montant' => rand(10, 500),
            ];
        }

        $this->db->table('dons')->insertBatch($data);
    }
}
