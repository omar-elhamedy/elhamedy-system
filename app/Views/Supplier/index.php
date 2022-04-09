<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
<?= 'الموردين' ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">الموردين</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary">تحديث</a>
            <a type="button" href="<?= site_url('/suppliers/new') ?>" class="btn btn-sm btn-outline-secondary">اضافة مورد جديد</a>
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
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">دفع دفعة</span>
    <?= form_open('/suppliers/pay', ['class'=>'row g-3']) ?>
        <div class="col-auto">
            <input type="text" placeholder="الاسم" class="form-control" id="client_name" name="supplier_name" required>
        </div>
        <div class="col-auto">
            <input type="text" class="form-control" name="amount_due" placeholder="المبلغ" required>
        </div>

        <div class="col-auto btn-block">
            <button type="submit" class="btn btn-success mb-3">خصم الدفعة</button>
        </div>
    <?= form_close() ?>
</section>
<section class="p-3">
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">توريد بضاعة</span>
    <?= form_open('/suppliers/supply', ['class'=>'row g-3']) ?>
    <div class="col-auto">
        <input type="text" placeholder="الاسم" class="form-control" id="client_name_pay" name="supplier_name_add" required>
    </div>

    <div class="col-auto btn-block">
        <button type="submit" class="btn btn-primary mb-3">توريد</button>
    </div>
    <?= form_close() ?>
</section>
<section class="p-3">

    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">عرض جميع التعاملات</span>

    <?= form_open('/suppliers/show', ['class'=>'row g-3']) ?>
        <div class="col-auto">
            <input type="text" placeholder="الاسم" class="form-control" id="client_name_2" name="supplier_name_search">
        </div>
        <div class="col-auto btn-block">
            <button type="submit" class="btn btn-success mb-3">عرض تاريخ التعاملات</button>
        </div>
    <?= form_close() ?>
</section>

<section class="p-3">

    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">احصائيات</span>
    <h4>اجمالي المبلغ الواجب دفعه: <?= $total ?> جنيه</h4>

</section>

<section class="p-3 mx-auto">
    <table class="table table-sm table-responsive table-bordered table-light table-hover rounded">
        <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">اسم المورد</th>
            <th scope="col">اجمالي المبلغ</th>
            <th scope="col">اخر دفعة</th>
            <th scope="col">اخر بضاعة</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?>
                <tr>
                    <td><?= $supplier->id ?></td>
                    <td><a href="<?= site_url('/suppliers/' . $supplier->id) ?>"><?= $supplier->name ?></a></td>
                    <td><?= $supplier->amount . ' جنيه'?></td>
                    <td></td>
                    <td><?= Time::parse( getLastImport($supplier->id)->created_at_supply_record, 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>


<script src="<?= site_url("/js/auto-complete.min.js") ?>"></script>

<script>
    var searchURL = "<?= site_url('/suppliers/search?q=') ?>";
    var searchAutoComplete = new autoComplete({
        selector: 'input[name="supplier_name"]',
        cache: false,
        minChars: 1,
        delay: 10,
        source: function (term, response){
            var request = new XMLHttpRequest();
            request.open('GET', searchURL + term, true);
            request.onload = function() {
                data = JSON.parse(this.response);
                var suggestion= data.map(customer => customer.name);
                response(suggestion);
            };
            request.send();
        }
    });
    var searchAutoComplete2 = new autoComplete({
        selector: 'input[name="supplier_name_search"]',
        cache: false,
        minChars: 1,
        delay: 10,
        source: function (term, response){
            var request = new XMLHttpRequest();
            request.open('GET', searchURL + term, true);
            request.onload = function() {
                data = JSON.parse(this.response);
                var suggestion= data.map(customer => customer.name);
                response(suggestion);
            };
            request.send();
        }
    });
    var searchAutoComplete3 = new autoComplete({
        selector: 'input[name="supplier_name_add"]',
        cache: false,
        minChars: 1,
        delay: 10,
        source: function (term, response){
            var request = new XMLHttpRequest();
            request.open('GET', searchURL + term, true);
            request.onload = function() {
                data = JSON.parse(this.response);
                var suggestion= data.map(customer => customer.name);
                response(suggestion);
            };
            request.send();
        }
    });
</script>
<?= $this->endSection(); ?>
