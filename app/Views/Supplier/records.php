<?php

use CodeIgniter\I18n\Time;

?>
<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
قائمة الفواتير
<?= $this->endSection() ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">فواتير توريد <?= getSupplierName($supplierID) ?></h1>

    <div class="btn-toolbar mb-2 mb-md-0">


            <div class="btn-group me-2">
                <a type="button" href="javascript:history.back()" class="btn btn-sm btn-outline-secondary">رجوع</a>

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
<section>




            <section class="p-3 mx-auto">
                <?= form_open('/suppliers/prices/update', ['id' => 'price']) ?>
                <table class="table caption-top table-sm table-responsive table-bordered table-light table-hover rounded">
                    <caption>قائمة الفواتير</caption>
                    <thead class="table-dark">
                    <tr>
                        <th scope="col" class="col-2">رقم الفاتورة</th>
                        <th scope="col">تاريخ الفاتورة</th>
                        <th scope="col">اجمالى الفاتورة</th>
                        <th scope="col">العملية</th>

                    </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($records as $record ):?>
                        <tr>
                        <th scope="row"><?= $record->id ?></th>
                        <td><?= Time::parse( $record->updated_at_supply_record, 'America/Chicago', 'ar_eg')->toLocalizedString(' d MMM, yyyy') ?></td>
                            <th scope="row"><?= $record->actual_total ?></th>
                        <td>
                            <div class="btn-toolbar" role="group">
                                    <a type="submit" href="<?= site_url('/suppliers/' . $supplierID .'/record/' . $record->id) ?>" class="btn btn-success mb-3 mx-2" >عرض</a>
                            </div>
                        </td>
                        </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>
            </section>

    <?= form_close() ?>
</section>

<?= $pager->links() ?>

<?= $this->endSection(); ?>
