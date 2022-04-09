<?php

namespace App\Libraries;

class getter
{
    private $productMetaModel;
    private $productModel;

    public function __construct()
    {
        $this->productMetaModel = new \App\Models\ProductMetaModel();
        $this->productModel = new \App\Models\ProductModel();
    }





    public function getProductMetaName($id)
    {
        return $this->productMetaModel->find($id)->name;
    }



    public function getAllProductsByColor($id)
    {
        return $this->productModel->getAllMetaProductsByColor($id);
    }



    public function getAllProductsBySize($id)
    {
        $model = new \App\Models\ProductModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $this->productModel->getAllMetaProductsBySize($id);
    }


    public function getAllProducts($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->getAllMetaProducts($id);
    }


    public function allProductsHasSameType($id): bool
    {
        $model = new \App\Models\ProductModel();
        $firstProduct = $id[0]->type_id;

        foreach ($id as $product) {
            if ($product->type_id === $firstProduct) {
                continue;
            } else {

                return false;
            }
        }

        return true;
    }




    public function getPriceOf($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->find($id)->price;
    }



    public function getProductColorId($id)
    {
        //dd($model->getProductsNumberByStorage($storage_id));
        return $this->productMetaModel->find($id)->color_id;
    }


    public function getMetaProductsCount($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->getAllMetaProductsCount($id);
    }


    public function getMetaProductsWithQTYCount($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->getMetaProductsWithQTYCount($id);
    }



    public function getPriceCalcMethod($itemID)
    {
        return $this->productMetaModel->find(intval($itemID))->price_calc_method;
    }



    public function getProductUnit($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->find($id)->unit_id;
    }




    public function getSupplierName($id)
    {
        $model = new \App\Models\SupplierModel();
        return $model->find($id)->name;
    }


    public function getProductName($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->find($id)->name;
    }



    public function getProductSizeName($id)
    {
        $sizeModel = new \App\Models\SizeCollectionModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $sizeModel->find($this->productMetaModel->find($id)->size_collection_id)->name;
    }

}