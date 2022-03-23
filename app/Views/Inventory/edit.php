<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">تعديل منتج "<?= $item->name ?>"</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="<?= site_url('/inv') ?>" class="btn btn-sm btn-outline-secondary">رجوع</a>

            </div>
        </div>
    </div>

<?php if(session()->has('errors')): ?>
    <?php foreach (session('errors') as $err): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                <?= $err ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(session()->has('info')): ?>

    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="success:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            <?= session()->get('info') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php endif; ?>

<section class="p-3">
    <?= form_open('/inv/update/' . $item->id) ?>
    <div class="col-2 btn-block">
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">اختر الخامة</span>
    <select class="form-select" aria-label="Disabled select example" name="material" disabled>
        <option value="" selected>اختر الخامة</option>
        <?php foreach ($materials as $material): ?>
        <option value="<?= $material->id ?>" <?= ($item->material_id === $material->id) ? 'selected':'' ?>><?= $material->name ?></option>
        <?php endforeach;?>
    </select>
    </div>
    <div class="col-2 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">اختر الماركة</span>
        <select class="form-select" aria-label="Default select example" name="brand" disabled>
            <option value="" selected>اختر الماركة</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand->id?>" <?= ($item->brand_id === $brand->id) ? 'selected':'' ?>><?= $brand->name ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="col-2 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">اختر النوع</span>
        <select class="form-select" aria-label="Default select example" name="type" disabled>
            <option value="" selected>اختر النوع</option>
            <?php foreach ($types as $type): ?>
                <option value="<?= $type->id ?>" <?= ($item->type_id === $type->id) ? 'selected':'' ?>><?= $type->name ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="col-2 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">اختر الوحدة المخزنية</span>
        <select class="form-select" aria-label="Default select example" name="unit" required>
            <option value="" selected>اختر الوحدة</option>
            <?php foreach ($units as $unit): ?>
                <option value="<?= $unit->id ?>" <?= ($item->unit_id === $unit->id) ? 'selected':'' ?>><?= $unit->name ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="col-2 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">حساب السعر حسب</span>
        <select class="form-select" aria-label="Default select example" name="product_price_calc" required>
            <option value="0" <?= ($item->price_calc_method === '0') ? 'selected':'' ?>>اوتوماتك</option>
            <option value="1" <?= ($item->price_calc_method === '1') ? 'selected':'' ?>>اللون</option>
            <option value="2" <?= ($item->price_calc_method === '2') ? 'selected':'' ?>>المقاس</option>
        </select>
    </div>
    <div class="col-2 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">اختر المخزن</span>
        <select class="form-select" aria-label="Default select example" name="storage" required>
            <option value="" selected>اختر المخزن</option>
            <?php foreach ($storages as $storage): ?>
                <option value="<?= $storage->id ?>" <?= ($item->storage_id === $storage->id) ? 'selected':'' ?> ><?= $storage->name ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="col-2 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">الوان المنتج</span>
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">سيتم انشاء منتج لكل لون مسجل بالفعل و عند اضافة لون جديد من قائمة الالوان سيتم انشاء منتج للون الجديد</span>
        <select class="form-select" aria-label="Default select example" name="color" disabled>
            <option value="" selected>اختر مجموعة الالوان</option>
            <option value="2" <?= ($item->color_id === '2') ? 'selected':'' ?>>لا يوجد لون</option>
            <option value="0" <?= ($item->color_id === '0') ? 'selected':'' ?>>جميع الالوان</option>
            <option value="1" <?= ($item->color_id === '1') ? 'selected':'' ?>>ابيض و اسود</option>

        </select>
    </div>

    <div class="col-2 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">مقاسات المنتج</span>
        <select class="form-select" aria-label="Default select example" name="size-collection" disabled>
            <option value="" selected>اختر مجموعة المقاسات</option>
            <?php foreach ($sizes as $size): ?>
                <option value="<?= $size->id ?>" <?= ($item->size_collection_id === $size->id) ? 'selected':'' ?> ><?= $size->name ?></option>
            <?php endforeach;?>
        </select>
    </div>

    <br>
    <div class="col-auto btn-block">
        <button type="submit" class="btn btn-success mb-3">تعديل</button>
    </div>
    <?= form_close() ?>
</section>

<?= $this->endSection(); ?>

