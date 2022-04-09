<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupplierPaymentRecords extends Migration
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
            'amount' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ],
            'supplier_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ],
            'created_at_payment_log' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_payment_log' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id')
            ->addForeignKey('supplier_id', 'supplier', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('supplier_payment_records');
    }

    public function down()
    {
        $this->forge->dropTable('supplier_payment_records');
    }
}
