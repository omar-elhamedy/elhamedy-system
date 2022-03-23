<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeProductPriceFromIntToDouble extends Migration
{
    public function up()
    {
       $this->forge->modifyColumn('product', [
           'price' => [
               'type' => 'double',
               'unsigned' => true,
               'null' => false
           ]
       ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('product', [
            'price' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ]
        ]);
    }
}
