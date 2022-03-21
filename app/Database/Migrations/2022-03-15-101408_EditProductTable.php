<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditProductTable extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('product', 'product_supplier_id_foreign');
        $this->forge->dropForeignKey('product', 'product_storage_id_foreign');
        $this->forge->dropColumn('product', 'supplier_id');
        $this->forge->dropColumn('product', 'storage_id');
    }

    public function down()
    {

        $this->forge->addColumn('product',[
            'storage_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
                'CONSTRAINT product_storage_id_foreign FOREIGN KEY(`storage_id`) REFERENCES `storage`(`id`)']);
        $this->forge->addColumn('product',[
            'supplier_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
                'CONSTRAINT product_supplier_id_foreign FOREIGN KEY(`supplier_id`) REFERENCES `supplier`(`id`)']
        );

    }
}
