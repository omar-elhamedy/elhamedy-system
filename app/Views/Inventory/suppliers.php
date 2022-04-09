<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">المنتجات > الموردين</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

            <a type="button" href="<?= site_url('/inv/suppliers') ?>" class="btn btn-sm btn-outline-secondary">الموردين</a>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>

