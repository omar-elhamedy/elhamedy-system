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



if (! function_exists('generateRGBColor')){
    function generateRGBColor($amount){
        $arrayOfColors = [];


        for ($i =1;$i <= $amount; $i++){
            array_push($arrayOfColors, 'rgba('.rand(80, 255).','.rand(100, 200).','.rand(64, 255).'0,.6)');
        }

        return json_encode($arrayOfColors);
    }
}