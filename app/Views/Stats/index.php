<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
<?= 'لوحة القيادة' ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">لوحة القيادة</h1>
</div>

<section class="p-3">
    <div class="row g-5">
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-header">
                    العملاء
                </div>
                <div class="card-body">
                    <h5 class="card-title">اجمالي المبلغ الواجب تحصيله : 4000</h5>
                    <h5 class="card-title">عدد العملاء : 6</h5>
                    <br>
                    <a href="#" class="btn btn-light">تفاصيل</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card bg-warning">
                <div class="card-header">
                    الحسابات
                </div>
                <div class="card-body">
                    <h5 class="card-title">بنك مصر : 4000</h5>
                    <h5 class="card-title">فودافون كاش : 3000</h5>
                    <br>
                    <a href="#" class="btn btn-primary">تفاصيل</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card">
                <div class="card-header">
                    العملاء
                </div>
                <div class="card-body">
                    <h5 class="card-title">اجمالي المبلغ الواجب تحصيله : 4000</h5>
                    <h5 class="card-title">عدد العملاء : 6</h5>
                    <a href="#" class="btn btn-primary">تفاصيل</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card">
                <div class="card-header">
                    العملاء
                </div>
                <div class="card-body">
                    <h5 class="card-title">اجمالي المبلغ الواجب تحصيله : 4000</h5>
                    <h5 class="card-title">عدد العملاء : 6</h5>
                    <a href="#" class="btn btn-primary">تفاصيل</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card">
                <div class="card-header">
                    العملاء
                </div>
                <div class="card-body">
                    <h5 class="card-title">اجمالي المبلغ الواجب تحصيله : 4000</h5>
                    <h5 class="card-title">عدد العملاء : 6</h5>
                    <a href="#" class="btn btn-primary">تفاصيل</a>
                </div>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection(); ?>
