<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">المخازن - <?= $storage->name ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary">تحديث</a>
            <a type="button" href="<?= site_url('/inv/suppliers') ?>" class="btn btn-sm btn-outline-secondary">الموردين</a>
            <a type="button" href="<?= site_url('/settings/product/new') ?>" class="btn btn-sm btn-outline-secondary">اضافة منتج</a>
            <a type="button" href="<?= site_url('/inv/new') ?>" class="btn btn-sm btn-outline-secondary">توريد بضاعة</a>
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
            <th scope="col">الخامة</th>
            <th scope="col">الماركة</th>
            <th scope="col">المقاس</th>
            <th scope="col">اللون</th>
            <th scope="col">النوع</th>
            <th scope="col">الكمية</th>
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
                    <td><?= getMaterialName($product->material_id) ?></td>
                    <td><?= getBrandName($product->brand_id) ?></td>
                    <td><?= getSizeName($product->size_id) ?></td>
                    <td><?= getColorName($product->color_id) ?></td>
                    <td><?= getTypeName($product->type_id) ?></td>
                    <td><?= $product->QTY ?></td>
                    <td>20</td>
                    <td>
                        <div class="btn-toolbar" role="group">
                             <button type="submit" class="btn btn-danger mb-3 mx-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop-<?=$product->id?>">سحب</button>

                            <?= form_open('settings/product/edit/' . $product->id) ?> <button type="submit" class="btn btn-success mb-3 mx-2">اضافة</button><?= form_close() ?>
                        </div>
                    </td>
                </tr>

        <?php endforeach; ?>
        </tbody>
    </table>

    <?php foreach ($products as $product): ?>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop-<?= $product->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?= $product->name ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="d-flex justify-content-between align-items-center mb-1 text-muted">الكمية المتوفرة: <?= $product->QTY ?> <?= getUnitName($product->unit_id) ?></span>
                            <span class="d-flex justify-content-between align-items-center mb-1 text-muted">كمية السحب</span>
                            <?= form_open('/clients/add', ['class'=>'row g-3']) ?>
                            <div class="col-auto">
                                <input type="number" max="<?= $product->QTY ?>" onmousewheel="onWheel()" min="1" placeholder="الكمية" class="form-control wheelable" id="qty-<?= $product->id ?>" name="qty-<?= $product->id ?>" required>
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

