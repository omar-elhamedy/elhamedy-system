<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMetaIdToProductLog extends Migration
{
    public function up()
    {
       $this->forge->addColumn('product_log', [
           'meta_id' => [
               'type' => 'INT',
               'constraint' => 5,
               'unsigned' => true,
           ],
           'CONSTRAINT product_meta_id_foreign_key FOREIGN KEY(`meta_id`) REFERENCES `product_meta`(`id`) ON DELETE CASCADE ON UPDATE CASCADE'
       ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('product_log', 'product_meta_id_foreign_key');
        $this->forge->dropColumn('product_log', 'meta_id');
    }
}
