<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeProductTable extends Migration
{
    public function up()
    {
       $this->forge->dropKey('product', 'name');
       $this->forge->modifyColumn('product', [
           'name' => [
               'type' => 'VARCHAR',
               'constraint' => 128,
               'unique' => false
           ]
       ]);
       $this->forge->addColumn('product', [
           'uid' => [
               'type' => 'INT',
               'constraint' => 5,
               'unique' => true
           ]
       ]);
    }

    public function down()
    {

        $this->forge->modifyColumn('product', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'unique' => true
            ]
        ]);
        $this->forge->dropColumn('product', 'uid');
    }
}
