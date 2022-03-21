<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= site_url('/settings/product/') ?>" class="btn btn-sm btn-outline-secondary">رجوع</a>

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

<?= form_open('/settings/product/' . $type . '/new', ['class' => 'row g-3']) ?>

<?= $this->include('/Settings/product/form') ?>

<div class="col-auto btn-block">
    <button type="submit" class="btn btn-primary mb-3"><?= $btnText ?></button>
</div>
<?= form_close() ?>


<section class="p-3 mx-auto">
    <table class="table table-sm table-responsive table-bordered table-light table-hover rounded">
        <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">الاسم</th>
            <th scope="col">العملية</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $item): ?>

            <tr style="vertical-align:middle;">
                <th scope="row"><?= $item->id ?></th>
                <td><?= $item->name ?></a></td>
                <td>
                    <div class="btn-toolbar" role="group">
                    <?= form_open('settings/product/'.$type.'/delete/' . $item->id) ?> <button type="submit" class="btn btn-danger mb-3 mx-2">حذف</button><?= form_close() ?>

                    <?= form_open('settings/product/'.$type.'/edit/' . $item->id) ?> <button type="submit" class="btn btn-primary mb-3 mx-2">تعديل</button><?= form_close() ?>
                    </div>
                </td>

            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</section>


<?= $this->endSection(); ?>
