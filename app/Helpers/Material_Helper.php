<?php

if (! function_exists('getMaterialName')){
    function getMaterialName($id){
        $model = new \App\Models\ProductMaterialModel();
        //dd($model->getProductsNumberByStorage($storage_id));
       return $model->find($id)->name;
    }
}