<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupplierRecordsTable extends Migration
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
                'null' => false
            ],
            'notes' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'created_at_supply_record' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_supply_record' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);

        $this->forge->addPrimaryKey('id')
            ->addForeignKey('supplier_id', 'supplier', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('supplier_records');
    }

    public function down()
    {
        $this->forge->dropTable('supplier_records');
    }
}
