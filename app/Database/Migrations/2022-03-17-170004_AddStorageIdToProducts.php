<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStorageIdToProducts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product', [
            'storage_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ]
            ,
            'CONSTRAINT product_storage_id_foreign FOREIGN KEY(`storage_id`) REFERENCES `storage`(`id`) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('product', 'product_storage_id_foreign');
        $this->forge->dropColumn('product', 'storage_id');
    }
}
