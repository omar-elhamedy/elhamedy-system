<?php

namespace App\Libraries;

use App\Models\ProductLogModel;

class Loging
{
    public function logProductImport($productID, $supplierID , $QTY, $price , $meta_id)
    {
       $productLogModel = new ProductLogModel();

       $result = $productLogModel->insert([
            'product_id' => $productID,
            'log_type' => 'import',
            'log_message' => 'تم توريد '. getProductName($productID) .' في المخزن من المورد '. getSupplierName($supplierID) .'',
            'QTY' => $QTY,
            'meta_id' => $meta_id,
            'price' => $price
        ]);

       if (!$result){
           return false;
       }
        return true;
    }

    public function logProductAdd($productID, $QTY)
    {
        $productLogModel = new ProductLogModel();
        $result = $productLogModel->insert([
            'product_id' => $productID,
            'log_type' => 'add',
            'log_message' => 'تم اضافة الكمية '. $QTY .' الي المنتج '. getProductName($productID) .'',
            'QTY' => $QTY,
        ]);

        if (!$result){
            return false;
        }
        return true;
    }

    public function logProductExport($productID, $QTY)
    {
        $productLogModel = new ProductLogModel();

        $result = $productLogModel->insert([
            'product_id' => $productID,
            'log_type' => 'export',
            'log_message' => 'تم سحب '. getProductName($productID) .' من المخزن ',
            'QTY' => $QTY
        ]);

        if (!$result){
            return false;
        }
        return true;
    }
}