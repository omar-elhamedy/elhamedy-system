<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">العميل (<?= $clientName ?>)</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= site_url('/clients') ?>" class="btn btn-sm btn-outline-secondary">رجوع</a>

        </div>
    </div>
</div>

<h6 class="h2">رقم الهاتف (<?= ($clientPhone === '') ? 'لا يوجد' : $clientPhone ?>)</h6>
<h6 class="h2">اجمالى المبلغ (<?= ($amount < 0) ? 'له في حسابنا ' . trim($amount, '-') : $amount ?> ج)</h6>
<section class="p-3 mx-auto">
    <table class="table table-sm table-bordered  table-light table-hover rounded">
        <thead class="table-dark">
        <tr>

            <th scope="col">دفع</th>
            <th scope="col">عليه</th>
            <th scope="col">وسيلة الدفع</th>
            <th scope="col">تاريخ العملية</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $record): ?>
                <tr style="vertical-align:middle;">

                    <td><?= $record->amount_paid ?></td>
                    <td><?= $record->amount_due ?></td>
                    <td><?= getPaymentMethodName($record->payment_method_id) ?></td>
                    <td><?= Time::parse($record->updated_at_client_record, 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy')?></td>
                </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>
<?= $pager->links() ?>


<?= $this->endSection(); ?>
