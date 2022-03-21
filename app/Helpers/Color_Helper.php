<?php

if (! function_exists('getColorName')){
    function getColorName($id){
        $model = new \App\Models\ProductColorModel();
        if ($id === null){
            return 'لا يوجد لون';
        }
        //dd($model->getProductsNumberByStorage($storage_id));
       return $model->find($id)->name;
    }
}