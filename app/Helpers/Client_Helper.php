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

if (! function_exists('getAllClients')){
    function getAllClients(){
        $model = new \App\Models\ClientModel();
        return $model->findAll();
    }
}

if (! function_exists('getAllSuppliers')){
    function getAllSuppliers(){
        $model = new \App\Models\SupplierModel();
        return $model->findAll();
    }
}