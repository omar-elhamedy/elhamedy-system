<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductType extends Migration
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
            'created_at_type' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_type' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('product_type');
    }

    public function down()
    {
        $this->forge->dropTable('product_type');
    }
}
