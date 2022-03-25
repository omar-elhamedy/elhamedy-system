<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPriceToProductSupplyRecord extends Migration
{
    public function up()
    {
       $this->forge->addColumn('supplier_records_items', [
           'price' => [
               'type' => 'double',
               'unsigned' => true,
               'null' => false
           ]
       ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supplier_records_items', 'price');
    }
}
