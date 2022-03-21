<?php

if (! function_exists('getTypeName')){
    function getTypeName($id){
        $model = new \App\Models\ProductTypeModel();
        //dd($model->getProductsNumberByStorage($storage_id));
       return $model->find($id)->name;
    }
}