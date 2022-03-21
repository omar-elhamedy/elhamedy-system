<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductMeta extends Migration
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
            'color_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'type_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'material_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'sizes' => [
                'type' => 'JSON',
                'null' => true
            ],
            'brand_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'unit_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at_product_meta' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_product_meta' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id')
            ->addForeignKey('type_id', 'product_type', 'id', 'CASCADE', 'CASCADE')
            ->addForeignKey('material_id', 'product_material', 'id', 'CASCADE', 'CASCADE')
            ->addForeignKey('unit_id', 'product_unit', 'id', 'CASCADE', 'CASCADE')
            ->addForeignKey('brand_id', 'product_brand', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_meta');
    }

    public function down()
    {
        $this->forge->dropTable('product_meta');
    }
}
