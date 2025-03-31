<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIColabUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'      => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true
            ],
            'last_name'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'first_name'   => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'address'      => [
                'type' => 'TEXT',
                'null' => true
            ],
            'country'      => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true
            ],
            'email'        => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
                'null'       => false
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true
            ],
            'password'     => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false
            ],

            'profile_picture' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],
        ]);

        $this->forge->addPrimaryKey('user_id');
        $this->forge->createTable('user');

    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
