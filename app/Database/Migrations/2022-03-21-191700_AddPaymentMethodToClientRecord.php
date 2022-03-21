<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPaymentMethodToClientRecord extends Migration
{
    public function up()
    {
        $this->forge->addColumn('clients_records', [
            'payment_method_id' => ['type' => 'INT',
            'constraint' => 5,
            'unsigned' => true
        ],
            'CONSTRAINT payment_method_id_foreign FOREIGN KEY(`payment_method_id`) REFERENCES `payment_method`(`id`) ON DELETE CASCADE ON UPDATE CASCADE'
            ]
        );
    }

    public function down()
    {
        $this->forge->dropForeignKey('clients_records', 'payment_method_id_foreign');
        $this->forge->dropColumn('clients_records', 'payment_method_id');
    }
}
