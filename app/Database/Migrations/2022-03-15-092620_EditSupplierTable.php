<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditSupplierTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('supplier', 'product');
    }

    public function down()
    {
        $this->forge->addColumn('supplier', ['product' => [
            'type' => 'json',
            'null' => true,
        ]]);
    }
}
