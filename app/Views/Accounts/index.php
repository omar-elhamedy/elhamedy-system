<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
حساب <?= $account->name ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">حساب <?= $account->name ?></h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary">تحديث</a>
            <a type="button" href="<?= site_url('/settings/payment') ?>" class="btn btn-sm btn-outline-secondary">اضافة حساب جديد</a>
        </div>
    </div>
</div>

<?php if(session()->has('errors')): ?>

        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                <?= session('errors') ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

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
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">ايداع</span>
    <?= form_open('/accounts/'.$account->id.'/add', ['class'=>'row g-3']) ?>
    <div class="col-auto">

                      <input type="text" placeholder="الاسم" class="form-control" id="name" name="name" required>

    </div>

        <div class="col-auto">
            <input type="text" class="form-control" name="amount" placeholder="المبلغ" required>
        </div>

        <div class="col-auto btn-block">
            <button type="submit" class="btn btn-success  mb-3">عليه</button>
        </div>
    <?= form_close() ?>
</section>

<section class="p-3">
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">سحب</span>
    <?= form_open('/accounts/'. $account->id .'/withdraw', ['class'=>'row g-3']) ?>
    <div class="col-auto">

        <input type="text" placeholder="الاسم" class="form-control" id="name" name="name" required>

    </div>
    <div class="col-auto">
        <input type="number" class="form-control" onmousewheel="onWheel()" step="100" name="amount" max="<?= getAccountTotal($account->id) ?>" placeholder="المبلغ" required>
    </div>

    <div class="col-auto btn-block">
        <button type="submit" class="btn btn-danger  mb-3">سحب</button>
    </div>
    <?= form_close() ?>
</section>


<h1>اجمالى الحساب: <?= getAccountTotal($account->id)  ?></h1>

<section class="p-3 mx-auto">
    <table class="table table-sm table-responsive table-bordered table-light table-hover rounded">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">الاسم</th>
                <th scope="col">سحب</th>
                <th scope="col">ايداع</th>
                <th scope="col">تاريخ الدفعة</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (getPaymentRecords($account->id) as $record): ?>
            <?php if ($record->client_id === null): ?>
                    <tr>
                        <th scope="row"><?= $record->id ?></th>
                        <td><?= $record->name  ?></td>
                        <td><?= $record->withdraw ?></td>
                        <td><?= $record->amount ?></td>
                        <td><?= Time::parse($record->created_at_payment_method_record, 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy') ?></td>
                    </tr>
            <?php else: ?>

            <tr>
                    <th scope="row"><?= $record->id ?></th>
                    <td><a href="<?= site_url('/clients/' . $record->client_id ) ?>"><?= getClientName($record->client_id)  ?></a></td>
                <td><?= $record->withdraw ?></td>
                    <td><?= $record->amount ?></td>
                <td><?= Time::parse($record->created_at_payment_method_record, 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy') ?></td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>



<?= $this->endSection(); ?>
