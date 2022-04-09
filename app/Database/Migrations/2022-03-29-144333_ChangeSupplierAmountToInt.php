<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeSupplierAmountToInt extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('supplier', [
            'amount' => [
                'type' => 'double',
                'null' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('supplier', [
            'amount' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ]
        ]);
    }
}
