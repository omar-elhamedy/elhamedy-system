<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
<?= $storage->name ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">المخازن - <?= $storage->name ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary">تحديث</a>
            <a type="button" href="<?= site_url('/settings/product/new') ?>" class="btn btn-sm btn-outline-secondary">اضافة منتج</a>
            <?php if (!bookmarked(uri_string())): ?>
            <?= form_open('/bookmark/add') ?>
                <input type="text" value="<?= uri_string() ?>" name="uri" hidden>
                <input type="text" value="<?= $storage->name ?>" name="title" hidden>
                <button type="submit"
                        class="btn btn-sm btn-outline-secondary"><svg id="Layer_1" width="24" height="24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="currentcolor" viewBox="0 0 91.5 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>add-bookmark</title><path class="cls-1" d="M62.42,0A29.08,29.08,0,1,1,33.34,29.08,29.08,29.08,0,0,1,62.42,0ZM3.18,19.65H24.73a38,38,0,0,0-1,6.36H6.35v86.75L37.11,86.12a3.19,3.19,0,0,1,4.18,0l31,26.69V66.68a39.26,39.26,0,0,0,6.35-2.27V119.7a3.17,3.17,0,0,1-5.42,2.24l-34-29.26-34,29.42a3.17,3.17,0,0,1-4.47-.33A3.11,3.11,0,0,1,0,119.7H0V22.83a3.18,3.18,0,0,1,3.18-3.18Zm55-2.79a4.1,4.1,0,0,1,.32-1.64l0-.06a4.33,4.33,0,0,1,3.9-2.59h0a4.23,4.23,0,0,1,1.63.32,4.3,4.3,0,0,1,1.39.93,4.15,4.15,0,0,1,.93,1.38l0,.07a4.23,4.23,0,0,1,.3,1.55v8.6h8.57a4.3,4.3,0,0,1,3,1.26,4.23,4.23,0,0,1,.92,1.38l0,.07a4.4,4.4,0,0,1,.31,1.49v.18a4.37,4.37,0,0,1-.32,1.55,4.45,4.45,0,0,1-.93,1.4,4.39,4.39,0,0,1-1.38.92l-.08,0a4.14,4.14,0,0,1-1.54.3H66.71v8.57a4.35,4.35,0,0,1-1.25,3l-.09.08a4.52,4.52,0,0,1-1.29.85l-.08,0a4.36,4.36,0,0,1-1.54.31h0a4.48,4.48,0,0,1-1.64-.32,4.3,4.3,0,0,1-1.39-.93,4.12,4.12,0,0,1-.92-1.38,4.3,4.3,0,0,1-.34-1.62V34H49.56a4.28,4.28,0,0,1-1.64-.32l-.07,0a4.32,4.32,0,0,1-2.25-2.28l0-.08a4.58,4.58,0,0,1-.3-1.54v0a4.39,4.39,0,0,1,.33-1.63,4.3,4.3,0,0,1,3.93-2.66h8.61V16.86Z"/></svg></button>
                <?= form_close() ?>
            <?php else: ?>
            <?= form_open('/bookmark/remove') ?>
                <input type="text" value="<?= uri_string() ?>" name="uri" hidden>
                <button type="submit"
                        class="btn btn-sm btn-outline-secondary active"><svg id="Layer_1" data-name="Layer 1" width="24" height="24" fill="currentcolor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91.5 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>remove-bookmark</title><path class="cls-1" d="M62.42,0A29.08,29.08,0,1,1,33.34,29.08,29.08,29.08,0,0,1,62.42,0ZM3.18,19.65H24.73a38,38,0,0,0-1,6.36H6.35v86.75L37.11,86.12a3.19,3.19,0,0,1,4.18,0l31,26.69V66.68a39.26,39.26,0,0,0,6.35-2.27V119.7a3.17,3.17,0,0,1-5.42,2.24l-34-29.26-34,29.42a3.17,3.17,0,0,1-4.47-.33A3.11,3.11,0,0,1,0,119.7H0V22.83a3.18,3.18,0,0,1,3.18-3.18Zm72.1,5.77a4.3,4.3,0,0,1,3,1.26,4.23,4.23,0,0,1,.92,1.38l0,.07a4.4,4.4,0,0,1,.31,1.49v.18a4.37,4.37,0,0,1-.32,1.55,4.45,4.45,0,0,1-.93,1.4,4.39,4.39,0,0,1-1.38.92l-.08,0a4.14,4.14,0,0,1-1.54.3H49.56a4.28,4.28,0,0,1-1.64-.32l-.07,0a4.32,4.32,0,0,1-2.25-2.28l0-.08a4.58,4.58,0,0,1-.3-1.54v0a4.39,4.39,0,0,1,.33-1.63,4.3,4.3,0,0,1,3.93-2.66Z"/></svg></button>
                <?= form_close() ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php if(session()->has('info')): ?>

    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            <?= session()->get('info') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php endif; ?>

<div class="container-fluid">

<div class="row align-items-start">


    <section class="sticky-top col-2 p-3 mx-auto">

        <h1 class="h2">تصفية المنتجات</h1>
        <?= form_open('/storage/view/' . $storage->id, [
                'method' => 'GET'
        ]) ?>
        <div class="col btn-block py-2">
            <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">ترتيب حسب</span>
            <select class="form-select" aria-label="Default select example"  name="sort-by" required>
                <option value="name" <?= ('name' === $SelectedSort) ? 'selected' : ''; ?>>الاسم</option>
                <option value="QTY" <?= ('QTY' === $SelectedSort) ? 'selected' : ''; ?>>الكمية</option>
                <option value="updated_at_product" <?= ('updated_at_product' === $SelectedSort) ? 'selected' : ''; ?>>اخر تحديث</option>
            </select>
            <div class="col-auto btn-block py-2">
                <button type="submit" class="btn btn-success mb-3 py-2">ترتيب</button>
            </div>
        </div>

        <div class="col btn-block py-1">
            <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">حسب الخامة</span>
            <select class="selectpicker" aria-label="Default select example" data-size="10" name="filter-material" data-live-search="true">
                <option value="" selected>الكل</option>
                <?php foreach ($materials as $item): ?>
                    <option value="<?= $item->id ?>" <?= ($item->id === $SelectedMaterialFilter) ? 'selected' : ''; ?> ><?= $item->name ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col btn-block py-1">
            <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">حسب الماركة</span>
            <select class="selectpicker" aria-label="Default select example" data-size="10" data-live-search="true" name="filter-brand">
                <option value="" selected>الكل</option>
                <?php foreach ($brands as $item): ?>
                    <option value="<?= $item->id ?>" <?= ($item->id === $SelectedBrandFilter) ? 'selected' : ''; ?> ><?= $item->name ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col btn-block py-1">
            <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">حسب المقاس</span>
            <select class="selectpicker" aria-label="Default select example" data-size="10" data-live-search="true" name="filter-size">
                <option value="" selected>الكل</option>
                <?php foreach ($sizes as $item): ?>
                    <option value="<?= $item->id ?>" <?= ($item->id === $SelectedSizeFilter) ? 'selected' : ''; ?> ><?= $item->name ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col btn-block py-1">
            <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">حسب اللون</span>
            <select class="selectpicker" aria-label="Default select example" data-size="10" data-live-search="true" name="filter-color">
                <option value="" selected>الكل</option>
                <?php foreach ($colors as $item): ?>
                    <option value="<?= $item->id ?>"  <?= ($item->id === $SelectedColorFilter) ? 'selected' : ''; ?>  ><?= $item->name ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col btn-block py-1">
            <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">حسب النوع</span>
            <select class="selectpicker" aria-label="Default select example" data-size="10" data-live-search="true" name="filter-type">
                <option value="" selected>الكل</option>
                <?php foreach ($types as $item): ?>
                    <option value="<?= $item->id ?>" <?= ($item->id === $SelectedTypeFilter) ? 'selected' : ''; ?> ><?= $item->name ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-auto btn-block py-2">
            <button type="submit" class="btn btn-success mb-3 py-2">تصفية</button>
        </div>
        <?= form_close() ?>

        <?= form_open('/storage/view/export/' . $storage->id) ?>
        <div class="col-auto btn-block py-2">
            <button type="submit" class="btn btn-success mb-3 py-2"> <i class="fa-solid fa-download"></i> حفظ منتجات هذا امخزن</button>
        </div>
        <?= form_close() ?>
    </section>

<section class="col p-3 mx-auto">

    <table class="table table-sm table-responsive table-bordered table-light table-hover rounded">
        <thead class="table-dark">
        <tr>

            <th scope="col">اسم المنتج</th>

            <th scope="col">الكمية</th>
            <th scope="col">سعر الوحدة</th>
            <th scope="col">قيمة المنتج</th>
            <th scope="col">العملية</th>

        </tr>
        </thead>
        <tbody>
        <?php if (empty($products)): ?>
            <tr style="vertical-align:middle; text-align: center; font-size: xx-large">

                <td colspan="9">المنتجات غير متوفرة</td>

            </tr>
        <?php endif;?>
        <?php foreach ($products as $product): ?>


                <tr style="vertical-align:middle;">

                    <td><a href="<?= site_url('storage/products/' . $product->id) ?>" class="link-primary" style="text-decoration: none"><?= $product->name ?></a></td>

                    <td><?= $product->QTY . ' ' . getUnitName($product->unit_id) ?></td>
                    <td><?= getPriceOf($product->id) .' جنيه' ?></td>
                    <td><?= getPriceOf($product->id)*$product->QTY .' جنيه' ?></td>
                    <td>
                        <div class="btn-toolbar" role="group">
                             <button type="submit" class="btn btn-danger mb-3 mx-2" data-bs-toggle="modal" data-bs-target="#add-<?=$product->id?>">سحب</button>

                            <button type="submit" class="btn btn-success mb-3 mx-2" data-bs-toggle="modal" data-bs-target="#remove-<?=$product->id?>">اضافة</button>
                        </div>
                    </td>
                </tr>

        <?php endforeach; ?>
        </tbody>
    </table>

    <?php foreach ($products as $product): ?>
        <!-- Modal -->
        <div class="modal fade" id="add-<?= $product->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?= $product->name ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="d-flex justify-content-between align-items-center mb-1 text-muted">الكمية المتوفرة: <?= $product->QTY ?> <?= getUnitName($product->unit_id) ?></span>
                            <span class="d-flex justify-content-between align-items-center mb-1 text-muted">كمية السحب</span>
                            <?= form_open('/storage/remove-item/' . $product->id, ['class'=>'row g-3']) ?>
                            <div class="col-auto">
                                <input type="number" max="<?= $product->QTY ?>" onmousewheel="onWheel()" min="1" placeholder="الكمية" class="form-control wheelable" id="qty-<?= $product->id ?>" name="qty" required>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">سحب</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="remove-<?= $product->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?= $product->name ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="d-flex justify-content-between align-items-center mb-1 text-muted">الكمية المتوفرة: <?= $product->QTY ?> <?= getUnitName($product->unit_id) ?></span>
                        <span class="d-flex justify-content-between align-items-center mb-1 text-muted">كمية الاضافة</span>
                        <?= form_open('/storage/add-item/' . $product->id, ['class'=>'row g-3']) ?>
                        <div class="col-auto">
                            <input type="number" onmousewheel="onWheel()" min="1" placeholder="الكمية" class="form-control wheelable" id="qty-<?= $product->id ?>" name="qty" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-success">اضافة</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>



    <?php endforeach; ?>
<?php if(!$filtered): ?>
    <?= $pager->links() ?>
    <?php endif; ?>
</section>

    <script>
        function onWheel() { }
    </script>

</div>
</div>
<?= $this->endSection(); ?>

