<?php

if (! function_exists('size_name')){
    function size_name($list){

        $list = json_decode($list);

        $model = new \App\Models\ProductSizeModel();
        $names = [];
        if ($list === null){
            return 'لا يوجد مقاسات';
        }
        foreach ($list as $item){
            $names[] = $model->find($item)->name;
        }


        return implode(' - ', $names);
    }
}

if (! function_exists('getSizeName')){
    function getSizeName($id){
        $model = new \App\Models\ProductSizeModel();
        if ($id === null){
            return 'لا يوجد مقاس';
        }
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->find($id)->name;
    }
}