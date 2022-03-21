<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">اسعار العملات</h1>
</div>

<section class="p-3 mx-auto">
    <table class="table table-sm table-bordered  table-light table-hover rounded">
        <thead class="table-dark">
        <tr>
            <th scope="col" style="text-align: center; font-size: xx-large" colspan="2">سعر الدولار الامريكى اليوم</th>
        </tr>
        </thead>
        <tbody>

            <tr style="vertical-align:middle;">
                <td style="font-size: x-large">الجنيه المصري</td>
                <td style="font-size: x-large"><?= $data->rates->EGP ?></td>
            </tr>

        </tbody>
    </table>
</section>
<?= $this->endSection(); ?>
