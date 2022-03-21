<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductMetaModel;

class Inventory extends BaseController
{
    public function index()
    {
        $model = new ProductMetaModel();

        return view("Inventory/index", [
            'products' => $model->findAll()
        ]);
    }

    public function suppliers()
    {
        return view("Inventory/suppliers");
    }
}
