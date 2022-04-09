<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
    سجل دفعات  <?= $supplier->name ?>
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">سجل دفعات  <?= $supplier->name ?></h1>

    <div class="btn-toolbar mb-2 mb-md-0">


        <div class="btn-group me-2">
            <a type="button" href="javascript:history.back()" class="btn btn-sm btn-outline-secondary">رجوع</a>

        </div>


    </div>
</div>

<section class="p-3 mx-auto">

    <table class="table caption-top table-sm table-responsive table-bordered table-light table-hover rounded">
        <caption>السجل</caption>
        <thead class="table-dark">
        <tr>
            <th scope="col">تاريخ الدفعة</th>
            <th scope="col">اجمالى الدفعة</th>


        </tr>
        </thead>
        <tbody>


        <?php foreach ($records as $record ):?>
            <tr>

                <td><?= Time::parse( $record->created_at_payment_log, 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy') ?></td>
                <th scope="row"><?= $record->amount ?></th>

            </tr>
        <?php endforeach; ?>


        </tbody>
    </table>
    <?= $pager->links() ?>
</section>

</section>


<?= $this->endSection() ?>
