<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientsRecords extends Migration
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
            'client_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'amount_paid' => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
            'amount_due' => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
            'created_at_client_record' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at_client_record' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id')
            ->addForeignKey('client_id', 'clients', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('clients_records');
    }

    public function down()
    {
        $this->forge->dropTable('clients_records');
    }
}
