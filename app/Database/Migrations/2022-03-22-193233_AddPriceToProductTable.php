<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPriceToProductTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product', [
            'price' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ]
        ]);
    }

    public function down()
    {
       $this->forge->dropColumn('product', 'price');
    }
}
