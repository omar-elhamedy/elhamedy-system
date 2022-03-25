<?php

if (! function_exists('getProductMetaName')){
    function getProductMetaName($id){
        $model = new \App\Models\ProductMetaModel();
        //dd($model->getProductsNumberByStorage($storage_id));
       return $model->find($id)->name;
    }
}

if (! function_exists('getAllProductsByColor')){
    function getAllProductsByColor($id){
        $model = new \App\Models\ProductModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->getAllMetaProductsByColor($id);
    }
}

if (! function_exists('getAllProductsBySize')){
    function getAllProductsBySize($id){
        $model = new \App\Models\ProductModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->getAllMetaProductsBySize($id);
    }
}
if (! function_exists('getAllProducts')) {
    function getAllProducts($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->getAllMetaProducts($id);
    }
}
if (! function_exists('allProductsHasSameType')) {
    function allProductsHasSameType($id):bool
    {
        $model = new \App\Models\ProductModel();
        $firstProduct = $id[0]->type_id;

        foreach ($id as $product){
            if ($product->type_id === $firstProduct){
                continue;
            } else {

                return false;
            }
        }

        return true;
    }

}

if (! function_exists('getPriceOf')){
    function getPriceOf($id){
        $model = new \App\Models\ProductModel();
        return $model->find($id)->price;
    }
}

if (! function_exists('getProductColorId')){
    function getProductColorId($id){
        $model = new \App\Models\ProductMetaModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->find($id)->color_id;
    }
}
if (! function_exists('getMetaProductsCount')) {
    function getMetaProductsCount($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->getAllMetaProductsCount($id);
    }
}
if (! function_exists('getMetaProductsWithQTYCount')) {
    function getMetaProductsWithQTYCount($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->getMetaProductsWithQTYCount($id);
    }
}

if (! function_exists('getPriceCalcMethod')) {
    function getPriceCalcMethod($itemID)
    {

        $meta = new \App\Models\ProductMetaModel();


        return $meta->find(intval($itemID))->price_calc_method;
    }
}

if (! function_exists('getProductUnit')) {
    function getProductUnit($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->find($id)->unit_id;
    }
}

if (! function_exists('getProductName')) {
    function getProductName($id)
    {
        $model = new \App\Models\ProductModel();
        return $model->find($id)->name;
    }
}

if (! function_exists('getProductSizeName')){
    function getProductSizeName($id){
        $model = new \App\Models\ProductMetaModel();
        $sizeModel = new \App\Models\SizeCollectionModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $sizeModel->find($model->find($id)->size_collection_id)->name;
    }
}