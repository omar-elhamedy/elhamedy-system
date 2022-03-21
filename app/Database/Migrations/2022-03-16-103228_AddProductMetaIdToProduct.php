<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductMetaIdToProduct extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product', [
            'meta_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ]
            ,
            'CONSTRAINT product_meta_id_foreign FOREIGN KEY(`meta_id`) REFERENCES `product_meta`(`id`) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('product', 'product_meta_id_foreign');
        $this->forge->dropColumn('product', 'meta_id');
    }
}
