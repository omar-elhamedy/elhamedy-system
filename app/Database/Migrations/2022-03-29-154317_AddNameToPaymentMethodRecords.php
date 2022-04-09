<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNameToPaymentMethodRecords extends Migration
{
    public function up()
    {

        $this->forge->addColumn('payment_method_record', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('payment_method_record', 'name');
    }
}
