<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductLogTable extends Migration
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
            'product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ],
            'log_type' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false
            ],
            'log_message' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false
            ],
            'QTY' =>    [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true
            ],
            'price' =>    [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true
            ],
            'created_at_product_log' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_product_log' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);

        $this->forge->addPrimaryKey('id')
            ->addForeignKey('product_id', 'product', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_log');
    }

    public function down()
    {
        $this->forge->dropTable('product_log');
    }
}
