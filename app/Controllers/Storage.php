<?php

namespace App\Controllers;

use App\Controllers\BaseController;



use App\Models\ProductBrandModel;
use App\Models\ProductColorModel;
use App\Models\ProductMaterialModel;
use App\Models\ProductMetaModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\ProductTypeModel;
use App\Models\StorageModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Storage extends BaseController
{

    public function index()
    {
        $model = new StorageModel();

        return view('Storage/index', [
            'storages' => $model->findAll()
        ]);
    }

    public function export($storageId)
    {
        $storageModel = new StorageModel();
        $productsModel = new ProductModel();
        $materials = new ProductMaterialModel();
        $brands = new ProductBrandModel();
        $colors = new ProductColorModel();
        $sizes = new ProductSizeModel();
        $types = new ProductTypeModel();

        $data = $productsModel->getAllProductsWithQTY($storageId);
        $file_name = $storageModel->find($storageId)->name . '.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'اسم المنتج');

        $sheet->setCellValue('B1', 'الخامة');

        $sheet->setCellValue('C1', 'الماركة');

        $sheet->setCellValue('D1', 'المقاس');
        $sheet->setCellValue('E1', 'اللون');
        $sheet->setCellValue('F1', 'النوع');
        $sheet->setCellValue('G1', 'الكمية');
        $count = 2;

        foreach($data as $row) {

            $sheet->setCellValue('A' . $count, $row->name);

            $sheet->setCellValue('B' . $count, getMaterialName($row->material_id));

            $sheet->setCellValue('C' . $count, getBrandName($row->brand_id));

            $sheet->setCellValue('D' . $count, getSizeName($row->size_id));

            $sheet->setCellValue('E' . $count, getColorName($row->color_id));

            $sheet->setCellValue('F' . $count, getTypeName($row->type_id));

            $sheet->setCellValue('G' . $count, $row->QTY);

            $count++;

        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);
        header("Content-Type: application/vnd.ms-excel");

        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length:' . filesize($file_name));

        flush();

        readfile($file_name);

        redirect()->back()->with('info', 'تم حفظ المنتجات');
        exit;




    }

    public function remove($productID)
    {
        $model = new ProductModel();

        $model->removeQTY($productID, $this->request->getPost('qty'));

        $loging = service('log');

        $loging->logProductExport($productID, $this->request->getPost('qty'));

        return redirect()->back()->with('info', 'تم تسجيل سحب ' . getProductName($productID));

    }

    public function add($itemID)
    {
        $model = new ProductModel();
        $model->addQTY($itemID, $this->request->getPost('qty'));
        $loging = service('log');
        $loging->logProductAdd($itemID, $this->request->getPost('qty'));
        return redirect()->back()->with('info', 'تم تسجيل الاضافة ل' . getProductName($itemID));
    }



    public function product($productID)
    {
        $productModel = new ProductModel();
        return view('Storage/product', [
            'product' => $productModel->find($productID)
        ]);
    }

    public function view($storageId)
    {
        $storageModel = new StorageModel();
        $productsModel = new ProductModel();
        $materials = new ProductMaterialModel();
        $brands = new ProductBrandModel();
        $colors = new ProductColorModel();
        $sizes = new ProductSizeModel();
        $types = new ProductTypeModel();

        if($this->request->getGet(  'sort-by') != null){
            $products = $productsModel->sortBy($storageId, $this->request->getGet(  'sort-by'));

        }else{
            $products = $productsModel->paginateAllProductsInStorage($storageId);
        }

        $requestedFilters = [];

        if ($this->request->getGet('filter-material') != ''){

            $requestedFilters['material_id'] = $this->request->getGet('filter-material');

        }
        if ($this->request->getGet('filter-brand') != ''){

            $requestedFilters['brand_id'] = $this->request->getGet('filter-brand');

        }
        if ($this->request->getGet('filter-size') != '') {

            $requestedFilters['size_id']  = $this->request->getGet('filter-size');

        }
        if ($this->request->getGet('filter-color') != ''){

            $requestedFilters['color_id'] = $this->request->getGet('filter-color');

        }
        if ($this->request->getGet('filter-type') != '') {

            $requestedFilters['type_id'] = $this->request->getGet('filter-type');

        }

        $search_terms = $this->request->getGet();
        foreach ($search_terms as $key => $value) {
            if (strlen($value) == '') {
                unset($search_terms[$key]);
            }
        }

        //dd($search_terms);

        $filtered = false;
        if (!empty($requestedFilters)){
            $products = $productsModel->filterThese($requestedFilters, $storageId);
            $filtered = true;
        }

        //dd($products->getAllProductsInStorage($storageId));
        return view('Storage/view', [
            'storage' => $storageModel->find($storageId),
            'products' => $products,
            'materials' => $materials->findAll(),
            'brands' => $brands->findALl(),
            'colors' => $colors->findAll(),
            'sizes' => $sizes->findAll(),
            'types' => $types->findAll(),
            'pager' => $productsModel->pager,
            'filtered' => $filtered,
            'SelectedColorFilter' => $this->request->getGet('filter-color'),
            'SelectedTypeFilter' => $this->request->getGet('filter-type'),
            'SelectedSizeFilter' => $this->request->getGet('filter-size'),
            'SelectedBrandFilter' => $this->request->getGet('filter-brand'),
            'SelectedMaterialFilter' => $this->request->getGet('filter-material'),
            'SelectedSort' => $this->request->getGet(  'sort-by'),
        ]);
    }


}
