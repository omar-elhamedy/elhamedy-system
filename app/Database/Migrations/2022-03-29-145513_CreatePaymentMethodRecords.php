<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentMethodRecords extends Migration
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
            'payment_method' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ],
            'amount' => [
                'type' => 'double',
                'null' => false
            ],
            'client_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true
            ],
            'created_at_payment_method_record' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_payment_method_record' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);

        $this->forge->addPrimaryKey('id')
            ->addForeignKey('payment_method', 'payment_method', 'id', 'CASCADE', 'CASCADE')
            ->addForeignKey('client_id', 'clients', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment_method_record');

    }

    public function down()
    {
        $this->forge->dropTable('payment_method_record');
    }
}
