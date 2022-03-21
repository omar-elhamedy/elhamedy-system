<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupplierProductTable extends Migration
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
            'supplier_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id')
            ->addForeignKey('supplier_id', 'supplier', 'id', 'CASCADE', 'CASCADE')
            ->addForeignKey('product_id', 'product_meta', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('supplier_products');
    }

    public function down()
    {
        $this->forge->dropTable('supplier_products');
    }
}
