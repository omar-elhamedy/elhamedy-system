<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
المورد (<?= $supplier->name ?>)
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">المورد (<?= $supplier->name ?>)</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <?php if (!bookmarked(uri_string())): ?>
            <?= form_open('/bookmark/add') ?>
            <a type="button" href="<?= site_url('/suppliers/edit/' . $supplier->id) ?>"
               class="btn btn-sm btn-outline-secondary">تعديل البيانات</a>
                <input type="text" value="<?= uri_string() ?>" name="uri" hidden>
                <input type="text" value="المورد (<?= $supplier->name ?>)" name="title" hidden>
                <button type="submit"
                        class="btn btn-sm btn-outline-secondary"><svg id="Layer_1" width="24" height="24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="currentcolor" viewBox="0 0 91.5 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>add-bookmark</title><path class="cls-1" d="M62.42,0A29.08,29.08,0,1,1,33.34,29.08,29.08,29.08,0,0,1,62.42,0ZM3.18,19.65H24.73a38,38,0,0,0-1,6.36H6.35v86.75L37.11,86.12a3.19,3.19,0,0,1,4.18,0l31,26.69V66.68a39.26,39.26,0,0,0,6.35-2.27V119.7a3.17,3.17,0,0,1-5.42,2.24l-34-29.26-34,29.42a3.17,3.17,0,0,1-4.47-.33A3.11,3.11,0,0,1,0,119.7H0V22.83a3.18,3.18,0,0,1,3.18-3.18Zm55-2.79a4.1,4.1,0,0,1,.32-1.64l0-.06a4.33,4.33,0,0,1,3.9-2.59h0a4.23,4.23,0,0,1,1.63.32,4.3,4.3,0,0,1,1.39.93,4.15,4.15,0,0,1,.93,1.38l0,.07a4.23,4.23,0,0,1,.3,1.55v8.6h8.57a4.3,4.3,0,0,1,3,1.26,4.23,4.23,0,0,1,.92,1.38l0,.07a4.4,4.4,0,0,1,.31,1.49v.18a4.37,4.37,0,0,1-.32,1.55,4.45,4.45,0,0,1-.93,1.4,4.39,4.39,0,0,1-1.38.92l-.08,0a4.14,4.14,0,0,1-1.54.3H66.71v8.57a4.35,4.35,0,0,1-1.25,3l-.09.08a4.52,4.52,0,0,1-1.29.85l-.08,0a4.36,4.36,0,0,1-1.54.31h0a4.48,4.48,0,0,1-1.64-.32,4.3,4.3,0,0,1-1.39-.93,4.12,4.12,0,0,1-.92-1.38,4.3,4.3,0,0,1-.34-1.62V34H49.56a4.28,4.28,0,0,1-1.64-.32l-.07,0a4.32,4.32,0,0,1-2.25-2.28l0-.08a4.58,4.58,0,0,1-.3-1.54v0a4.39,4.39,0,0,1,.33-1.63,4.3,4.3,0,0,1,3.93-2.66h8.61V16.86Z"/></svg></button>
                <?= form_close() ?>
            <?php else: ?>
            <?= form_open('/bookmark/remove') ?>
            <a type="button" href="<?= site_url('/suppliers/edit/' . $supplier->id) ?>"
               class="btn btn-sm btn-outline-secondary">تعديل البيانات</a>
                <input type="text" value="<?= uri_string() ?>" name="uri" hidden>
                <button type="submit"
                        class="btn btn-sm btn-outline-secondary active"><svg id="Layer_1" data-name="Layer 1" width="24" height="24" fill="currentcolor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91.5 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>remove-bookmark</title><path class="cls-1" d="M62.42,0A29.08,29.08,0,1,1,33.34,29.08,29.08,29.08,0,0,1,62.42,0ZM3.18,19.65H24.73a38,38,0,0,0-1,6.36H6.35v86.75L37.11,86.12a3.19,3.19,0,0,1,4.18,0l31,26.69V66.68a39.26,39.26,0,0,0,6.35-2.27V119.7a3.17,3.17,0,0,1-5.42,2.24l-34-29.26-34,29.42a3.17,3.17,0,0,1-4.47-.33A3.11,3.11,0,0,1,0,119.7H0V22.83a3.18,3.18,0,0,1,3.18-3.18Zm72.1,5.77a4.3,4.3,0,0,1,3,1.26,4.23,4.23,0,0,1,.92,1.38l0,.07a4.4,4.4,0,0,1,.31,1.49v.18a4.37,4.37,0,0,1-.32,1.55,4.45,4.45,0,0,1-.93,1.4,4.39,4.39,0,0,1-1.38.92l-.08,0a4.14,4.14,0,0,1-1.54.3H49.56a4.28,4.28,0,0,1-1.64-.32l-.07,0a4.32,4.32,0,0,1-2.25-2.28l0-.08a4.58,4.58,0,0,1-.3-1.54v0a4.39,4.39,0,0,1,.33-1.63,4.3,4.3,0,0,1,3.93-2.66Z"/></svg></button>
                <?= form_close() ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if (session()->has('errors')): ?>
    <?php foreach (session('errors') as $err): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill"/>
            </svg>
            <div>
                <?= $err ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (session()->has('info')): ?>

    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="success:">
            <use xlink:href="#exclamation-triangle-fill"/>
        </svg>
        <div>
            <?= session()->get('info') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php endif; ?>

<section class="p-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">بيانات المورد</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">الاسم : <?= $supplier->name ?></li>
            <?php if($supplier->phone_number != null): ?>
            <li class="list-group-item">رقم الهاتف : <?= $supplier->phone_number ?></li>
            <?php endif; ?>
            <?php if($supplier->phone_number != null): ?>
                <li class="list-group-item">الحساب البنكى : <?= $supplier->bank_account ?></li>
            <?php endif; ?>
            <?php if($supplier->amount != null): ?>
            <?php if ($supplier->amount > 0): ?>
                <li class="list-group-item">حساب المورد : <?= $supplier->amount ?> جنيه</li>
                <?php else: ?>
                    <li class="list-group-item">لنا في حسابه : <?=abs($supplier->amount) ?> جنيه</li>
            <?php endif;?>
            <?php endif; ?>

        </ul>
    </div>
</section>
<section>


    <div class="col-auto btn-block">
        <a type="button" href="<?= site_url('/suppliers/' . $supplier->id . '/supply-items') ?>"
           class="btn btn-success mb-3">انشاء فاتورة توريد</a>
        <a type="button" href="<?= site_url('/suppliers/' . $supplier->id . '/records') ?>"
           class="btn btn-primary mb-3">عرض فواتير التوريد</a>
        <a type="button" href="<?= site_url('/suppliers/' . $supplier->id . '/payments') ?>"
           class="btn btn-warning mb-3">عرض سجل الدفعات</a>
    </div>


    <div class="py-2">
        <h4>قائمة المنتجات</h4>
    </div>

    <input type="text" class="form-control" id="myInput" placeholder="بحث">


    <section class="p-3 mx-auto">
        <?= form_open('/suppliers/prices/update', ['id' => 'price']) ?>
        <table class="table table-sm table-responsive table-bordered table-light table-hover rounded">
            <thead class="table-dark">
            <tr>
                <th scope="col">اسم المنتج</th>
                <th scope="col">سعر المنتج</th>
                <th scope="col">الوحدة</th>

            </tr>
            </thead>
            <tbody id="myTable">

            <?php foreach ($products as $product): ?>



                <?php if (getPriceCalcMethod($product->product_id) === '0'): ?>

                    <?= view('/Supplier/table-View/1', ['product' => $product]) ?>

                    <?= view('/Supplier/table-view/0', ['product' => $product]) ?>

                    <?= view('/Supplier/table-view/2', ['product' => $product]) ?>


                <?php elseif (getPriceCalcMethod($product->product_id) === '1'): ?>

                    <?php if (!allProductsHasSameType(getAllProductsBySize($product->product_id))): ?>

                        <?php if (!empty(getAllProductsByColor($product->product_id))): ?>
                            <?php foreach (getAllProductsByColor($product->product_id) as $item): ?>
                                <?= view('Storage/table', [
                                    'product_id' => $product->product_id,
                                    'item' => $item,
                                    'name' => "color[$item->color_id]",
                                    'label' => getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getColorName($item->color_id) . ' ' . getTypeName($item->type_id)
                                ]) ?>

                            <?php endforeach; ?>
                        <?php endif; ?>

                    <?php else: ?>

                        <?php if (!empty(getAllProductsByColor($product->product_id))): ?>
                            <?php foreach (getAllProductsByColor($product->product_id) as $item): ?>
                                <?= view('Storage/table', [
                                    'product_id' => $product->product_id,
                                    'item' => $item,
                                    'name' => "type[$item->type_id][colors][$item->color_id]",
                                    'label' => getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getColorName($item->color_id) . ' ' . getTypeName($item->type_id)
                                ]) ?>

                            <?php endforeach; ?>
                        <?php endif; ?>

                    <?php endif; ?>

                <?php elseif (getPriceCalcMethod($product->product_id) === '2'): ?>

                    <?php if (!empty(getAllProducts($product->product_id))): ?>
                        <?php foreach (getAllProducts($product->product_id) as $item): ?>
                            <?= view('Storage/table', [
                                'product_id' => $product->product_id,
                                'item' => $item,
                                'name' => "$item->id",
                                'label' => getMaterialName($item->material_id) . ' ' . getBrandName($item->brand_id) . ' ' . getSizeName($item->size_id) . ' ' . getColorName($item->color_id) . ' ' . getTypeName($item->type_id)
                            ]) ?>

                        <?php endforeach; ?>
                    <?php endif; ?>

                <?php endif; ?>


            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <div class="col-auto btn-block">
        <button type="submit" form="price" class="btn btn-success mb-3">تحديث الاسعار</button>
    </div>
    <?= form_close() ?>
</section>

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<?= $this->endSection(); ?>
