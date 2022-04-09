<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">اعدادات المنتجات</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">


        </div>
    </div>
</div>

<section class="p-3">
    <div class="row g-5">
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card text-dark bg-warning">
                <div class="card-header">
                    المنتجات
                </div>
                <div class="card-body">
                    <h5 class="card-title">انشاء منتج جديد</h5>
                    <br>
                    <a href="<?= site_url('/settings/product/new') ?>" class="btn btn-primary">انشاء</a>
                    <a href="<?= site_url('/inv') ?>" class="btn btn-primary">عرض المنتجات</a>
                </div>
            </div>

        </div>

        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-header">
                    الالوان
                </div>
                <div class="card-body">
                    <h5 class="card-title">اضافة الوان للمنتجات</h5>
                    <br>
                    <a href="<?= site_url('/settings/product/color') ?>" class="btn btn-light">اضافة</a>
                </div>
            </div>

        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">

            <div class="card text-white bg-primary">
                <div class="card-header">
                    النوع
                </div>
                <div class="card-body">
                    <h5 class="card-title">اضافة انواع للمنتجات</h5>
                    <h7 class="card-title">مثال "قصب و سادة"</h7>
                    <br>
                    <br>
                    <a href="<?= site_url('/settings/product/type') ?>" class="btn btn-light">اضافة</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">

            <div class="card text-white bg-primary">
                <div class="card-header">
                    الخامة
                </div>
                <div class="card-body">
                    <h5 class="card-title">اضافة خامات للمنتجات</h5>
                    <h7 class="card-title">مثال "ساتان و استك"</h7>
                    <br>
                    <br>
                    <a href="<?= site_url('/settings/product/material') ?>" class="btn btn-light">اضافة</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">

            <div class="card text-white bg-primary">
                <div class="card-header">
                    الماركة
                </div>
                <div class="card-body">
                    <h5 class="card-title">اضافة ماركات للمنتجات</h5>
                    <h7 class="card-title">مثال "التعاون و الحسينى"</h7>
                    <br>
                    <br>
                    <a href="<?= site_url('/settings/product/brand') ?>" class="btn btn-light">اضافة</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">

            <div class="card text-white bg-primary">
                <div class="card-header">
                    مقاسات
                </div>
                <div class="card-body">
                    <h5 class="card-title">اضافة مقاسات للمنتجات</h5>
                    <h7 class="card-title">مثال "2سم و 3سم"</h7>
                    <br>
                    <br>
                    <a href="<?= site_url('/settings/product/size') ?>" class="btn btn-light">اضافة</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">

            <div class="card text-white bg-primary">
                <div class="card-header">
                    مجموعة مقاسات
                </div>
                <div class="card-body">
                    <h5 class="card-title">انشاء مجموعة مقاسات</h5>
                    <h7 class="card-title">مثال "مقاسات الاستك"</h7>
                    <br>
                    <br>
                    <a href="<?= site_url('/settings/product/size-collection') ?>" class="btn btn-light">اضافة</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">

            <div class="card text-white bg-primary">
                <div class="card-header">
                    الوحدة المخزنية
                </div>
                <div class="card-body">
                    <h5 class="card-title">اضافة الوحدات المخزنية للمنتجات</h5>
                    <h7 class="card-title">مثال "باكو و توب"</h7>
                    <br>
                    <br>
                    <a href="<?= site_url('/settings/product/unit') ?>" class="btn btn-light">اضافة</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">

            <div class="card text-white bg-primary">
                <div class="card-header">
                    المخازن
                </div>
                <div class="card-body">
                    <h5 class="card-title">اضافة مخزن جديد</h5>
                    <br>
                    <br>
                    <a href="<?= site_url('/settings/product/storage') ?>" class="btn btn-light">اضافة</a>
                </div>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection(); ?>
