<?php

if (! function_exists('getBrandName')){
    function getBrandName($id){
        $model = new \App\Models\ProductBrandModel();
        //dd($model->getProductsNumberByStorage($storage_id));
       return $model->find($id)->name;
    }
}