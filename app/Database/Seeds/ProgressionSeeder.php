<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProgressionSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'but' => rand(1000, 10000),
                'status' => rand(0, 1),
                'id_publication' => $i,
                'donations_collected' => rand(0, 5000),
                'target_amount' => rand(5000, 20000),
            ];
        }

        $this->db->table('progressions')->insertBatch($data);
    }
}
