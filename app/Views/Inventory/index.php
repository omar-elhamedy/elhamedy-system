<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">المنتجات</h1>
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
        <?php foreach ($products as $product): ?>
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-header">
                    <?= $product->name ?>
                </div>
                <div class="card-body">
                   <span>الخامة : <a href="<?= site_url('/inv/material/' . $product->material_id) ?>" class="text-white"><?= $product->material_id ?></a></span>
                    <br><br>
                    <a href="<?= site_url('settings/product') ?>" class="btn btn-light">تعديل</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</section>
<?= $this->endSection(); ?>
