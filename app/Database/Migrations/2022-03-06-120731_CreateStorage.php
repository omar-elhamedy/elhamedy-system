<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStorage extends Migration
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
                'unique' => true
            ],
            'created_at_storage' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_storage' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('storage');
    }

    public function down()
    {
        $this->forge->dropTable("storage");
    }
}
