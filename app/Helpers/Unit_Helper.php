<?php

if (! function_exists('getUnitName')){
    function getUnitName($id){
        $model = new \App\Models\ProductUnitModel();
        //dd($model->getProductsNumberByStorage($storage_id));
       return $model->find($id)->name;
    }
}