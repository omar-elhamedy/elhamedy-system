<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">العملاء</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary">تحديث</a>
            <a type="button" href="<?= site_url('/clients/new') ?>" class="btn btn-sm btn-outline-secondary">اضافة عميل جديد</a>
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

<section class="p-3">
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">اضافة مبلغ علي عميل</span>
    <?= form_open('/clients/add', ['class'=>'row g-3']) ?>
        <div class="col-auto">
            <input type="text" placeholder="الاسم" class="form-control" id="client_name" name="client_name" required>
        </div>
        <div class="col-auto">
            <input type="text" class="form-control" name="amount_due" placeholder="المبلغ" required>
        </div>

        <div class="col-auto btn-block">
            <button type="submit" class="btn btn-danger  mb-3">عليه</button>
        </div>
    <?= form_close() ?>
</section>
<section class="p-3">
    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">دفع مبلغ من عميل</span>
    <?= form_open('/clients/pay', ['class'=>'row g-3']) ?>
    <div class="col-auto">
        <input type="text" placeholder="الاسم" class="form-control" id="client_name_pay" name="client_name_pay" required>
    </div>
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="المبلغ" name="amount_paid" required>
    </div>
    <div class="col-auto">
        <select class="form-select" name="payment_method">
            <option value="" selected>اختر وسيلة الدفع</option>
            <?php foreach ($paymentMethods as $method):?>
                <option value="<?= $method->id ?>"><?= $method->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-auto btn-block">
        <button type="submit" class="btn btn-primary mb-3">دفع</button>
    </div>
    <?= form_close() ?>
</section>
<section class="p-3">

    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">عرض جميع التعاملات</span>

    <?= form_open('/clients/show', ['class'=>'row g-3']) ?>
        <div class="col-auto">
            <input type="text" placeholder="الاسم" class="form-control" id="client_name_2" name="client_name_2">
        </div>
        <div class="col-auto btn-block">
            <button type="submit" class="btn btn-success mb-3">عرض تاريخ التعاملات</button>
        </div>
    <?= form_close() ?>
</section>

<section class="p-3">

    <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">احصائيات</span>

<h4>اجمالي المبلغ الواجب تحصيله: <?= $total ?> جنيه</h4>
</section>

<section class="p-3 mx-auto">
    <table class="table table-sm table-responsive table-bordered table-light table-hover rounded">
        <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">الاسم</th>
            <th scope="col">اجمالي المبلغ</th>
            <th scope="col">اخر دفعة</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clients as $client): ?>
        <?php if ($client->amount != 0): ?>
        <tr style="vertical-align:middle;">
            <th scope="row"><?= $client->id ?></th>
            <td><a href="<?= site_url('/clients/' . $client->id) ?>" class="link-success" style="text-decoration: none"><?= $client->name ?></a></td>
            <td><?= ($client->amount < 0) ? 'له في حسابنا ' . trim($client->amount, '-') : $client->amount?></td>
            <td><?= Time::parse($client->updated_at_client_record, 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy') ?></td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>


<script src="<?= site_url("/js/auto-complete.min.js") ?>"></script>

<script>
    var searchURL = "<?= site_url('/clients/search?q=') ?>";
    var searchAutoComplete = new autoComplete({
        selector: 'input[name="client_name"]',
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
        selector: 'input[name="client_name_2"]',
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
        selector: 'input[name="client_name_pay"]',
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
