<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditProductColorColumn extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('product', [
            'color_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('product', [
            'color_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ]
        ]);
    }
}
