<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        // $this->call('PublicationSeeder');
        // $this->call('ProgressionSeeder');
        $this->call('GroupSeeder'); // Fixed typo
        $this->call('GroupMemberSeeder'); // Added
        // $this->call('DonSeeder'); // Added
    }
}
