<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupplyRecordItems extends Migration
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
            'record_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ],
            'QTY' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ]
        ]);

        $this->forge->addPrimaryKey('id')
            ->addForeignKey('product_id', 'product', 'id', 'CASCADE', 'CASCADE')
            ->addForeignKey('record_id', 'supplier_records', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('supplier_records_items');
    }

    public function down()
    {
        $this->forge->dropTable('supplier_records_items');
    }
}
