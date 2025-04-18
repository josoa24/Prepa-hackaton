<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PublicationSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 200; $i++) {
            $data[] = [
                'id_user' => rand(1, 5),
                'title' => "Event $i: " . ['Charity Run', 'Food Drive', 'Community Cleanup', 'Art Workshop', 'Tech Meetup'][rand(0, 4)],
                'content' => "Join us for Event $i! This is a great opportunity to make a difference in your community.",
                'description' => "Details about Event $i. Don't miss out!",
                'date_publication' => date('Y-m-d H:i:s', strtotime("-" . rand(1, 30) . " days")),
                'date_evenement' => rand(0, 1) ? date('Y-m-d H:i:s', strtotime("+" . rand(1, 30) . " days")) : null,
                'type'=> ['Event', 'News', 'Update'][rand(0, 2)],
                'forme' => rand(1, 3),
            ];
        }

        $this->db->table('Publication')->insertBatch($data);
    }
}
