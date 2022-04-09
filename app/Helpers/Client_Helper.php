<?php

use CodeIgniter\I18n\Time;

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



if (! function_exists('getClientName')){
    function getClientName($id){
        $model = new \App\Models\ClientModel();


        return $model->find($id)->name;
    }
}

if (! function_exists('getClientOldestPayment')){
    function getClientOldestPayment($id){
        $model = new \App\Models\ClientRecordsModel();
        $payment = $model->where('client_id', $id)->orderBy('created_at_client_record', 'ASC')->first();
        if ($payment === null){
            return '';
        } else {
        $date = $payment->created_at_client_record;
        $date = Time::parse($date, 'America/Chicago');

        return $date->format('Y-m-d');
        }

    }
}

if (! function_exists('getClientNewestPayment')){
    function getClientNewestPayment($id){
        $model = new \App\Models\ClientRecordsModel();
        $payment = $model->where('client_id', $id)->orderBy('created_at_client_record', 'DESC')->first();

        if ($payment === null){

            return '';
        } else {
            $date = $payment->created_at_client_record;
            $date = Time::parse($date, 'America/Chicago');

            return $date->format('Y-m-d');
        }
    }
}






if (! function_exists('getClientCount')){
    function getClientCount(){
        $model = new \App\Models\ClientModel();
        return $model->where('amount >', '0')->countAllResults();
    }
}


if (! function_exists('getClientTotalAmount')){
    function getClientTotalAmount(){
        $model = new \App\Models\ClientModel();
        return $model->getTotal();
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