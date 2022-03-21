<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddQTYtoProductTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product', [
            'QTY' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ]
        ]);
    }

    public function down()
    {
       $this->forge->dropColumn('product', 'QTY');
    }
}
