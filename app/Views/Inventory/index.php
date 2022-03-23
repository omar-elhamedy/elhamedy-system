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
                    <a href="<?= site_url('inv/edit/' . $product->id) ?>" class="btn btn-light">تعديل</a>
                    <a  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#product-<?= $product->id ?>">حذف</a>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="product-<?= $product->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تأكيد حذف المنتج "<?= $product->name ?>"</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            بتأكيد الحذف سوف تقوم بحذف <?= getMetaProductsCount($product->id) ?> منتج فرعى منهم <?= getMetaProductsWithQTYCount($product->id) ?> منتجات مسجل لها كمية
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                            <a href="<?= site_url('/inv/delete/' . $product->id) ?>" type="button" class="btn btn-primary">تأكيد الحذف</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>
<?= $this->endSection(); ?>
