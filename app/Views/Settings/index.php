<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">الاعدادات</h1>
</div>

<section class="p-3">
    <div class="row g-5">
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-header">
                    المنتجات
                </div>
                <div class="card-body">
                    <h5 class="card-title">ضبت اعدادات المنتجات</h5>
                    <br>
                    <a href="<?= site_url('settings/product') ?>" class="btn btn-light">اعدادات</a>
                </div>
            </div>
        </div>

    <div class="col-xs-6 col-sm-4 col-md-3">

        <div class="card text-white bg-primary">
            <div class="card-header">
                وسائل الدفع
            </div>
            <div class="card-body">
                <h5 class="card-title">اضافة وسيلة دفع</h5>
                <h7 class="card-title">مثال "فودافون كاش و بنك مصر"</h7>
                <br>
                <br>
                <a href="<?= site_url('/settings/payment/') ?>" class="btn btn-light">اضافة</a>
            </div>
        </div>
    </div>
    </div>
</section>
<?= $this->endSection(); ?>
