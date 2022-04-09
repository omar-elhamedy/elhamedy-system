<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActualTotalToSupplyRecord extends Migration
{
    public function up()
    {
        $this->forge->addColumn('supplier_records', [
            'actual_total' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supplier_records', 'actual_total');
    }
}
