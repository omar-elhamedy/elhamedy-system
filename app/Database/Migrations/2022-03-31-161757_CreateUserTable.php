<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at_user' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_user' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('user');

    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
