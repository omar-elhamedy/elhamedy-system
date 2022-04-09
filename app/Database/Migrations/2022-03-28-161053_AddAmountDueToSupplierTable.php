<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAmountDueToSupplierTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('supplier', [
            'amount' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supplier', 'amount');
    }
}
