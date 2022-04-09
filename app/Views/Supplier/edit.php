<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
<?= 'مورد جديد' ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">تعديل بيانات مورد</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

                <button type="button" class="btn btn-danger mb-3"  data-bs-toggle="modal" data-bs-target="#delete">حذف هذا المورد</button>


        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تأكيد حذف <?= $supplier->name ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               هل انت متأكد بأنك تريد حذف المورد <?= $supplier->name ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                <a type="button" href="<?= site_url('/suppliers/remove/' . $supplier->id) ?>" class="btn btn-danger">تأكيد</a>
            </div>
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

<?= form_open('/suppliers/update/' . $supplier->id, ['class' => 'row g-3 my-3']) ?>
<h3 class="py-3">بيانات المورد</h3>
<div class="row mb-3">
    <div class="col-auto">
        <input type="text" placeholder="الاسم" class="form-control form-control-lg" value="<?= $supplier->name ?>" id="client_name" name="supplier_name" required>
    </div>

</div>

<div class="row mb-3">
    <div class="col-auto">
        <input type="text" class="form-control form-control-lg" name="phone_number" value="<?= $supplier->phone_number ?>" placeholder="رقم الهاتف">
    </div>
</div>
<div class="row mb-3">
    <div class="col-auto">
        <input type="text" class="form-control form-control-lg" name="bank_account" value="<?= $supplier->bank_account ?>" placeholder="رقم الحساب البنكى">
    </div>
</div>

<h3>المنتجات الموردة</h3>

<div class="col-2 btn-block">
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">اختر المنتجات المورة من قبل هذا المورد</span>
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">ملحوظة: لن تستطيع اختار منتج مسجل لمورد من قبل</span>

    <select class="selectpicker" aria-label="Default select example" name="products[]" multiple required>

        <?php foreach ($products as $product): ?>

            <option value="<?= $product->id ?>"<?= (isProductAlreadyAttachedToSupplier($product->id) ?'disabled':'') ?> <?= (checkSupplierHaveProduct($supplier->id, $product->id)) ? 'selected' : '' ?>><?= $product->name ?></option>
        <?php endforeach; ?>
    </select>


    <div class="col-auto pt-5 btn-block">
        <button type="submit" class="btn btn-primary mb-3">تعديل</button>
        <a type="button" href="javascript:history.back()" class="btn btn-danger mb-3">الغاء</a>
    </div>
</div>




<?= form_close() ?>

<?= $this->endSection(); ?>
