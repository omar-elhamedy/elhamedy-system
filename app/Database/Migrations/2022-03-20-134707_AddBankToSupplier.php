<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBankToSupplier extends Migration
{
    public function up()
    {
        $this->forge->addColumn('supplier', [
            'bank_account' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'unique' => true
                ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supplier', 'bank_account');
    }
}
