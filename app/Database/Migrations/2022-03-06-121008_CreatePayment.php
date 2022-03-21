<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePayment extends Migration
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
            'created_at_payment' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_payment' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('payment_method');
    }

    public function down()
    {
        $this->forge->dropTable("payment_method");
    }
}
