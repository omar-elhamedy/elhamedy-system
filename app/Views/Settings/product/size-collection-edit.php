<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= site_url('/settings/product/' . $type) ?>" class="btn btn-sm btn-outline-secondary">رجوع</a>

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

<?= form_open('/settings/product/' . $type . '/update/' . $data->id, ['class' => 'row g-3']) ?>


<div class="mb-3">
    <div class="col-sm">
        <input type="text" placeholder="الاسم" class="form-control form-control-lg" id="name" value="<?= $data->name ?>" name="name" autofocus>
    </div>
</div>

<?php foreach ($Availablesizes as $size): ?>
<div class="col-2 btn-block">
    <div class="form-check form-check-inline">
        <?php $checked = '';
        if (json_decode($data->sizes) !== null): ?>
        <?php $checked = in_array($size->id,json_decode($data->sizes)) ? 'checked' : ''; ?>
        <?php endif; ?>
        <input class="form-check-input" type="checkbox" name="sizes[]" id="inlineCheckbox<?= $size->id ?>" value="<?= $size->id ?>"  <?= $checked ?>>
        <label class="form-check-label" for="inlineCheckbox<?= $size->id ?>"><?= $size->name ?></label>
    </div>
</div>
<?php endforeach;?>

<div class="col-auto btn-block">
    <button type="submit" class="btn btn-primary mb-3"><?= $btnText ?></button>
</div>
<?= form_close() ?>




<?= $this->endSection(); ?>
