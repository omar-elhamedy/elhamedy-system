<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSizeCollectionsTable extends Migration
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
            'sizes' => [
                'type' => 'JSON',
                'null' => false
            ],
            'created_at_size_collection' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_size_collection' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('sizecollections');
    }

    public function down()
    {
        $this->forge->dropTable('sizecollections');
    }
}
