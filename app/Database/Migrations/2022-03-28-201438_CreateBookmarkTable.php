<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookmarkTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'uri' => [
                'type' => 'varchar',
                'constraint' => 128,
                'null' => false,
                'unique' => true
            ],
            'uri_title' => [
                'type' => 'varchar',
                'constraint' => 128,
                'null' => false
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('bookmark');
    }

    public function down()
    {
        $this->forge->dropTable('bookmark');
    }
}
