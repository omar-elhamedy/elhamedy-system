<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStorageIdToProductMeta extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product_meta', [
            'storage_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ]
            ,
            'CONSTRAINT storage_id_foreign FOREIGN KEY(`storage_id`) REFERENCES `storage`(`id`) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('product_meta', 'storage_id_foreign');
        $this->forge->dropColumn('product_meta', 'storage_id');
    }
}
