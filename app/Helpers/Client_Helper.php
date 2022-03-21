<?php

if (! function_exists('getPaymentMethodName')){
    function getPaymentMethodName($id){
        $model = new \App\Models\PaymentMethodModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        if ($id === null){
            return 'ــ';
        }
       return $model->find($id)->name;
    }
}