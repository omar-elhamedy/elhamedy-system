<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
<?= 'لوحة القيادة' ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">لوحة القيادة</h1>
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

        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-header">
                    العملاء
                </div>
                <div class="card-body">
                    <h5 class="card-title">اجمالي المبلغ الواجب تحصيله : <?= getClientTotalAmount() ?></h5>
                    <h5 class="card-title">عدد العملاء عليهم فلوس : <?= getClientCount() ?></h5>
                    <br>
                    <a href="<?= site_url('/clients') ?>" class="btn btn-light">تفاصيل</a>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-header">
                    الموردين
                </div>
                <div class="card-body">
                    <h5 class="card-title">اجمالي المبلغ الواجب دفعه : <?= getSuppliersTotalAmount() ?></h5>
                    <h5 class="card-title">عدد الموردين ليهم فلوس : <?= getSuppliersCount() ?></h5>
                    <a href="<?= site_url('/suppliers') ?>" class="btn btn-light">تفاصيل</a>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-header">
                    الحسابات
                </div>

                <div class="card-body">
                    <?php foreach (getAllPaymentMethods() as $paymentMethod): ?>
                    <h5 class="card-title"><?= $paymentMethod->name ?> : <?= getAccountTotal($paymentMethod->id) ?></h5>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>




    </div>

</section>


<?= $this->endSection(); ?>
