<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'ساتان',
            'استك',
            'سوستة',
            'خيط'
        ];

        for ($i = 0; $i < count($data); $i++){
            $this->db->table('product_material')->insert([
                'name' => $data[$i],
                'created_at_material' => date("Y-m-d H:i:s"),
                'updated_at_material' => date("Y-m-d H:i:s")
            ]);
        }

    }
}
