<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPriceCalculationMethodToProductMeta extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product_meta', [
            'price_calc_method' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('product_meta', 'price_calc_method');
    }
}
