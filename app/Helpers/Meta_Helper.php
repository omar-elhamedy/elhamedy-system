<?php

if (! function_exists('getProductMetaName')){
    function getProductMetaName($id){
        $model = new \App\Models\ProductMetaModel();
        //dd($model->getProductsNumberByStorage($storage_id));
       return $model->find($id)->name;
    }
}

if (! function_exists('getAllProductsByColor')){
    function getAllProductsByColor($id){
        $model = new \App\Models\ProductModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->getAllMetaProductsByColor($id);
    }
}

if (! function_exists('getAllProductsBySize')){
    function getAllProductsBySize($id){
        $model = new \App\Models\ProductModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->getAllMetaProductsBySize($id);
    }
}


if (! function_exists('getProductColorId')){
    function getProductColorId($id){
        $model = new \App\Models\ProductMetaModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->find($id)->color_id;
    }
}


if (! function_exists('getProductSizeName')){
    function getProductSizeName($id){
        $model = new \App\Models\ProductMetaModel();
        $sizeModel = new \App\Models\SizeCollectionModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $sizeModel->find($model->find($id)->size_collection_id)->name;
    }
}