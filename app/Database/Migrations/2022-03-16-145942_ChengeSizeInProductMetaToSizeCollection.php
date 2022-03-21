<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChengeSizeInProductMetaToSizeCollection extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('product_meta', 'sizes');
        $this->forge->addColumn('product_meta', [
            'size_collection_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'CONSTRAINT size_collection_id_foreign FOREIGN KEY(`size_collection_id`) REFERENCES `sizecollections`(`id`)'
        ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('product_meta', 'size_collection_id_foreign');
        $this->forge->dropColumn('product_meta', 'size_collection_id');
        $this->forge->addColumn('product_meta', [
            'sizes' => [
                'type' => 'JSON',
                'null' => true
            ]
        ]);
    }
}
