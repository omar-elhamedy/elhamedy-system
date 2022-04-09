<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWithdrawToPaymentMethodRecords extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('payment_method_record', [
            'amount' => [
                'type' => 'double',
                'null' => true
            ],
        ]);
        $this->forge->addColumn('payment_method_record', [
            'withdraw' => [
                'type' => 'double',

                'null' => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('payment_method_record', 'withdraw' );
        $this->forge->modifyColumn('payment_method_record', [
            'amount' => [
                'type' => 'double',
                'null' => false
            ],
        ]);
    }
}
