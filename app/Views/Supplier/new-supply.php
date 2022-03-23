<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("content"); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">فاتورة توريد جديدة ل<?= $supplier->name ?></h1>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a type="button" href="<?= site_url('/suppliers') ?>" class="btn btn-sm btn-outline-secondary">رجوع</a>

        </div>
    </div>
</div>


<section class="p-3">
    <div class="col-5 btn-block">
        <span class="p-2 d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">ملحوظات الفاتورة</span>
        <textarea class="form-control" aria-label="With textarea"></textarea>
    </div>

    <div class="col-2 pt-3 btn-block">
        <select class="selectpicker" aria-label="Default select example"  data-size="10" data-live-search="true" name="storage" required>
            <option value="" selected>اختر النتج</option>
            <?php foreach ($products as $meta): ?>
                <?php foreach (getAllProducts($meta->product_id) as $product): ?>
                    <option value="<?= $product->id ?>"><?= $product->name ?></option>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-auto py-2 btn-block">
        <button type="submit" form="price" class="btn btn-success mb-3">اضافة منتج</button>
    </div>

    <table class="table table-borderless">
        <thead>
        <tr>

            <th scope="col">اسم المنتج</th>

            <th scope="col">الكمية</th>
            <th scope="col">سعر الوحدة</th>
            <th scope="col">قيمة المنتج</th>

        </tr>
        </thead>
        <tbody>

        <tr class="align-middle">
            <td>2</td>
            <td>2</td>
            <td>2</td>
            <td>2</td>
        </tr>

        <tr class="align-bottom">

            <td></td>
            <td></td>
            <td></td>
            <td>200</td>

        </tr>
        </tbody>
    </table>

</section>


<?= $this->endSection(); ?>
