<?php

if (! function_exists('getAllProductsInStorage')){
    function getAllProductsInStorage($storage_id){
        $model = new \App\Models\ProductMetaModel();
        //dd($model->getProductsNumberByStorage($storage_id));
       return $model->getProductsNumberByStorage($storage_id);
    }
}

if (! function_exists('getProductCount')){
    function getProductCount($storage_id){
        $model = new \App\Models\ProductModel();
        return $model->getCountOfProductInStorage($storage_id);
    }
}

if (! function_exists('getActualProductCount')){
    function getActualProductCount($storage_id){
        $model = new \App\Models\ProductModel();
        return $model->getActualCountOfProductInStorage($storage_id);
    }
}