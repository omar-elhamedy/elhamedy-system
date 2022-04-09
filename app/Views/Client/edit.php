<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
تعديل بيانات عميل
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">تعديل بيانات عميل</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">


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
<?= form_open('/clients/update/' . $client->id, ['class' => 'row g-3 my-3']) ?>

<div class="row mb-3">
    <div class="col-auto">
        <input type="text" placeholder="الاسم" class="form-control form-control-lg" value="<?= $client->name ?>" id="client_name" name="client_name" required>
    </div>

</div>

<div class="row mb-3">
    <div class="col-auto">
        <input type="text" class="form-control form-control-lg" name="phone_number" value="<?= $client->phone_number ?>" placeholder="رقم الهاتف">
    </div>
</div>
<div class="col-auto btn-block">
    <button type="submit" class="btn btn-primary mb-3">تعديل</button>
    <a type="button" href="javascript:history.back()" class="btn btn-danger mb-3">الغاء</a>
</div>


<?= form_close() ?>

<?= $this->endSection(); ?>
