<?php


use CodeIgniter\I18n\Time;

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



if (! function_exists('getAccountTotal')){
    function getAccountTotal($id){
        $model = new \App\Models\PaymentMethodRecordsModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        $add= $model->where('payment_method', $id)->selectSum('amount')->first()->amount;
        $withdraw = $model->where('payment_method', $id)->selectSum('withdraw')->first()->withdraw;
        return $add-$withdraw;
    }
}

if (! function_exists('getSuppliersTotalAmount')){
    function getSuppliersTotalAmount(){
        $model = new \App\Models\SupplierModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        $add= $model->selectSum('amount')->first()->amount;

        return $add;

    }
}



if (! function_exists('getTop5MaterialinNamesQTY')){
    function getTop5MaterialinNamesQTY(){
        $model = new \App\Models\ProductModel();
        $all = $model->select(['product_material.name AS material_name', 'product_unit.name AS unit_name' ,'material_id', 'type_id'])->join('product_unit', 'product_unit.id = product.unit_id', 'INNER')->join('product_material', 'product_material.id = product.material_id', 'INNER')->groupBy('unit_name')->selectSum('QTY')->groupBy('material_name')->orderBy('QTY', 'DESC')->get(5)->getResultArray();

        $names = $model->select('product_material.name')->join('product_material', 'product_material.id = product.material_id', 'INNER')->selectSum('QTY')->groupBy('name')->orderBy('QTY', 'DESC')->get(5)->getResultArray();
        $namesArray = [];
        $valueArray = [];
        foreach ($all as $value){
            $prt1 = $value['material_name'];
            $prt2 = $value['unit_name'];
            array_push($namesArray, "$prt1-$prt2");
            array_push($valueArray, $value['QTY']);
        }

        return json_encode($namesArray);

    }
}



if (! function_exists('getTop5MaterialinQTY')){
    function getTop5MaterialinQTY(){
        $model = new \App\Models\ProductModel();
        $all = $model->select(['product_material.name AS material_name', 'product_unit.name AS unit_name' ,'material_id', 'type_id'])->join('product_unit', 'product_unit.id = product.unit_id', 'INNER')->join('product_material', 'product_material.id = product.material_id', 'INNER')->groupBy('unit_name')->selectSum('QTY')->groupBy('material_name')->orderBy('QTY', 'DESC')->get(5)->getResultArray();

        $names = $model->select('product_material.name')->join('product_material', 'product_material.id = product.material_id', 'INNER')->selectSum('QTY')->groupBy('name')->orderBy('QTY', 'DESC')->get(5)->getResultArray();
        $namesArray = [];
        $valueArray = [];
        foreach ($all as $value){
            $prt1 = $value['material_name'];
            $prt2 = $value['unit_name'];
            array_push($namesArray, "$prt1-$prt2");
            array_push($valueArray, $value['QTY']);
        }

        return json_encode($valueArray);

    }
}


if (! function_exists('getSuppliersCount')){
    function getSuppliersCount(){
        $model = new \App\Models\SupplierModel();

        return $model->where('amount >', '0')->asArray()->countAllResults();

    }
}




if (! function_exists('getPaymentRecords')){
    function getPaymentRecords($id){
        $model = new \App\Models\PaymentMethodRecordsModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->where('payment_method', $id)->paginate();
    }
}


if (! function_exists('getAllPaymentMethods')){
    function getAllPaymentMethods(){
        $model = new \App\Models\PaymentMethodModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->findAll();
    }
}


if (! function_exists('getLastImport')){
    function getLastImport($id){
        $model = new \App\Models\SupplierRecordsModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->getLastImport($id);
    }
}

if (! function_exists('getProductAttributeNames')){
    function getProductAttributeNames($id){
        $model = new \App\Models\ProductModel();
        //dd($model->getProductsNumberByStorage($storage_id));
        return $model->getProductAttributeNames($id);
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




if (! function_exists('getSupplierName')) {
    function getSupplierName($id)
    {
        $model = new \App\Models\SupplierModel();
        return $model->find($id)->name;
    }
}
if (! function_exists('getProductName')) {
    function getProductName($id)
    {
        $model = new \App\Models\ProductModel();

        return $model->find(intval($id))->name;
    }
}



if (! function_exists('getLastExportDate')) {
    function getLastExportDate($id)
    {
        $model = new \App\Models\ProductLogModel();

        $result = $model->where('meta_id', $id)->where('log_type', 'import')->orderBy('created_at_product_log', 'DESC')->first();

        if ($result === null){
            return null;
        }

        return Time::parse(strval($result->created_at_product_log), 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy');

    }
}

if (! function_exists('isProductAlreadyAttachedToSupplier')) {
    function isProductAlreadyAttachedToSupplier($productID)
    {
        $model = new \App\Models\SupplierProductModel();

        return $model->isProductAlreadyAttachedToSupplier($productID);
    }
}


if (! function_exists('checkSupplierHaveProduct')) {
    function checkSupplierHaveProduct($supplierID, $productID)
    {
        $model = new \App\Models\SupplierProductModel();

        return $model->isSupplierGotThisProduct($supplierID, $productID);
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