<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PublicationSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'id_user' => rand(1, 10),
                'title' => "Publication Title $i",
                'content' => "This is the content of publication $i.",
                'description' => "Publication description $i.",
                'date_publication' => date('Y-m-d H:i:s', strtotime("+$i days")),
                'date_evenement' => $i % 2 === 0 ? date('Y-m-d H:i:s', strtotime("+$i days +2 hours")) : null,
            ];
        }

        // Insert data into the Publication table
        $this->db->table('Publication')->insertBatch($data);
    }
}
