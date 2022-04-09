<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
<?= $product->name ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">منتج - <?= $product->name ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary">تحديث</a>

            <a type="button" href="<?= site_url('/settings/product/new') ?>" class="btn btn-sm btn-outline-secondary">اضافة منتج</a>

        </div>
    </div>
</div>

<section class="p-3">
    <div class="row gx-2">
        <div class="col-2">
            <span class="p-3 border bg-light">كمية المنتج : <?= $product->QTY ?></span>
            <span class="p-3 border bg-light">سعر المنتج : <?= $product->price ?></span>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
