<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">المخازن</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary">تحديث</a>
            <a type="button" href="<?= site_url('/inv/suppliers') ?>" class="btn btn-sm btn-outline-secondary">الموردين</a>
            <a type="button" href="<?= site_url('/settings/product/new') ?>" class="btn btn-sm btn-outline-secondary">اضافة منتج</a>
            <a type="button" href="<?= site_url('/inv/new') ?>" class="btn btn-sm btn-outline-secondary">توريد بضاعة</a>
        </div>
    </div>
</div>

<section class="p-3">
    <div class="row g-5">
        <?php foreach ($storages as $storage): ?>
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <?= $storage->name ?>
                    </div>
                    <div class="card-body">
                        <span>عدد المنتجات ذات كمية بالمخزن : <?= getProductCount($storage->id) ?></span>
                        <br>
                        <span>عدد المنتجات الفعلى : <?= getActualProductCount($storage->id) ?></span>
                        <br>      <br>
                        <a href="<?= site_url('storage/view/' . $storage->id) ?>" class="btn btn-light">عرض</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>
<?= $this->endSection(); ?>

